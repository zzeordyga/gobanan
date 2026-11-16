import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';

export default function AdminReviews({ reviews }) {
    return (
        <AdminLayout title="Reviews">
            <h2 className="text-xl font-bold mb-4">Reviews</h2>
            <div className="surface overflow-x-auto">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">Service</th><th className="p-3">Reviewer</th><th className="p-3">Rating</th><th className="p-3">Title</th></tr></thead>
                    <tbody>
                        {reviews.data.length === 0 ? <tr><td className="p-6 text-muted" colSpan="4">No reviews.</td></tr> :
                            reviews.data.map((r) => (
                                <tr key={r.id} className="border-t border-border">
                                    <td className="p-3"><Link href={route('services.show', r.service.id)} className="hover:text-brand line-clamp-1">{r.service.name}</Link></td>
                                    <td className="p-3 text-muted">{r.user?.name}</td>
                                    <td className="p-3 text-accent">{'★'.repeat(r.rating)}</td>
                                    <td className="p-3 line-clamp-1">{r.title}</td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>
        </AdminLayout>
    );
}