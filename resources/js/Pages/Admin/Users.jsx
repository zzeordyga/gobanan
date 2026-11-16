import AdminLayout from '@/Layouts/AdminLayout';
import { Link, useForm } from '@inertiajs/react';

export default function AdminUsers({ users }) {
    const makeAdmin = useForm();
    const makeMember = useForm();

    const toggle = (u) => {
        if (u.role === 'admin') {
            makeMember.patch(route('admin.users.make-member', u.id));
        } else {
            makeAdmin.patch(route('admin.users.make-admin', u.id));
        }
    };

    return (
        <AdminLayout title="Users">
            <h2 className="text-xl font-bold mb-4">Users</h2>
            <div className="surface overflow-x-auto">
                <table className="w-full text-sm">
                    <thead className="surface-2 text-left eyebrow"><tr><th className="p-3">Name</th><th className="p-3">Username</th><th className="p-3">Email</th><th className="p-3">Role</th><th className="p-3 text-right">Actions</th></tr></thead>
                    <tbody>
                        {users.data.length === 0 ? <tr><td className="p-6 text-muted" colSpan="5">No users.</td></tr> :
                            users.data.map((u) => (
                                <tr key={u.id} className="border-t border-border">
                                    <td className="p-3"><Link href={route('users.show', u.id)} className="hover:text-brand">{u.name}</Link></td>
                                    <td className="p-3 text-muted">{u.username}</td>
                                    <td className="p-3 text-muted">{u.email}</td>
                                    <td className={`p-3 ${u.role === 'admin' ? 'text-accent font-medium' : ''}`}>{u.role}</td>
                                    <td className="p-3 text-right">
                                        <button onClick={() => toggle(u)} className={u.role === 'admin' ? 'text-muted hover:underline' : 'text-brand hover:underline'}>
                                            {u.role === 'admin' ? 'Make member' : 'Make admin'}
                                        </button>
                                    </td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>
        </AdminLayout>
    );
}