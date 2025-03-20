import AppLayout from "@/layouts/app-layout"
import { type BreadcrumbItem } from "@/types"
import { useState } from "react"
import { router, Head } from "@inertiajs/react"

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Timesheets',
        href: '/timesheets',
    },
];

interface Timesheet {
    id: number;
    task_date: string;
    task_name: string;
    task_duration_minutes: number;
}

export default function TimesheetsIndex({ timesheets }: { timesheets: Timesheet[] }) {
    const [taskName, setTaskName] = useState('');
    const [taskDuration, setTaskDuration] = useState('');

    function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault()
        router.post(route('timesheets.store'), {
            task_date: new Date().toISOString().split('T')[0],
            task_name: taskName,
            task_duration_minutes: taskDuration,
        });
        
        setTaskName('');
        setTaskDuration('');
    }

    function translateToHoursAndMinutes(minutes: number) {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;

        if (hours > 24) {
            return `${Math.floor(hours / 24)}d ${hours % 24}h`;
        }

        return `${hours}h ${mins}m`;
    }

    return (
        <>
            <Head title="View" />
            <AppLayout breadcrumbs={breadcrumbs}>
                <div className="flex gap-4 p-2">
                    <div className="w-2/3">
                        <div className="w-full flex justify-between">
                            <table className="w-full border">
                                <thead>
                                    <tr>
                                        <th className="bg-gray-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">Task Date</th>
                                        <th className="bg-gray-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">Task Name</th>
                                        <th className="bg-gray-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-right">Task Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {timesheets.map((timesheet) => (
                                        <tr key={timesheet.id}>
                                            <td className="border border-neutral-200 dark:border-neutral-800 text-right p-1">{timesheet.task_date}</td>
                                            <td className="border border-neutral-200 dark:border-neutral-800 text-right">{timesheet.task_name}</td>
                                            <td className="border border-neutral-200 dark:border-neutral-800 text-right">{ translateToHoursAndMinutes(timesheet.task_duration_minutes)}</td>
                                        </tr>
                                    ))}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colSpan={3} className="font-bold border border-neutral-200 dark:border-neutral-800 text-right p-1">Total: {translateToHoursAndMinutes(timesheets.reduce((acc, timesheet) => acc + timesheet.task_duration_minutes, 0))}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div className="w-1/3 flex justify-center bg-blue-200">
                        <div className="w-1/2 flex flex-col gap-4 border-t pt-4">
                            <form className="flex flex-col gap-2" onSubmit={handleSubmit}>
                                <div className="flex flex-col gap-2">
                                    <label htmlFor="taskName">Task Name</label>
                                    <input className="rounded-md border p-4 border-gray-300 dark:border-neutral-800 bg-white dark:bg-neutral-900" id="taskName" value={taskName} onChange={(e) => setTaskName(e.target.value)} />
                                </div>
                                <div className="flex flex-col gap-2">
                                    <label htmlFor="taskDuration">Task Duration</label>
                                    <select className="rounded-md border p-4 border-gray-300 dark:border-neutral-800 bg-white dark:bg-neutral-900" id="taskDuration" value={taskDuration} onChange={(e) => setTaskDuration(e.target.value)}>
                                        {Array.from({ length: 1500 }, (_, i) => (
                                            <option key={i} value={i * 60}>{translateToHoursAndMinutes(i * 60)}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="mt-14 flex flex-col p-6">
                                    <button className="rounded-md border p-4 border-gray-300 dark:border-neutral-800 bg-gray-100 dark:bg-neutral-900" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </AppLayout>
        </>
    );
}
