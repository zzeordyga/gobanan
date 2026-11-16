import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';

export default function AdminIndex({ stats }) {
    const targets = {
        users: 'admin.users.index', services: 'admin.services.index',
        categories: 'admin.categories.index', transactions: 'admin.transactions.index',
        reviews: 'admin.reviews.index',
    };
    return (
        <AdminLayout title="Overview">
            <div className="grid grid-cols-2 lg:grid-cols-5 gap-4">
                {Object.entries(stats).map(([label, count]) => (
                    <Link key={label} href={route(targets[label])} className="surface p-5 hover:shadow-md transition">
                        <p className="eyebrow">{label.charAt(0).toUpperCase() + label.slice(1)}</p>
                        <p className="text-3xl font-bold mt-1 text-accent">{count}</p>
                    </Link>
                ))}
            </div>
        </AdminLayout>
    );
}