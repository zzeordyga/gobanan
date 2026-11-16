import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

function classNames(...c) {
    return c.filter(Boolean).join(' ');
}

const navItems = [
    { route: 'admin.index', label: 'Overview' },
    { route: 'admin.categories.index', label: 'Categories' },
    { route: 'admin.services.index', label: 'Services' },
    { route: 'admin.reviews.index', label: 'Reviews' },
    { route: 'admin.transactions.index', label: 'Transactions' },
    { route: 'admin.users.index', label: 'Users' },
];

export default function AdminLayout({ title, children }) {
    const { auth } = usePage().props;
    const [open, setOpen] = useState(false);

    return (
        <div className="min-h-screen bg-bg text-text lg:flex">
            <aside className="lg:w-64 lg:shrink-0 surface-2 lg:min-h-screen lg:sticky lg:top-0 border-b lg:border-b-0 lg:border-r border-border">
                <div className="p-4 flex items-center justify-between">
                    <Link href={route('admin.index')} className="flex items-center gap-2 font-bold">
                        <span className="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-accent text-white font-black">g</span>
                        Admin
                    </Link>
                    <button onClick={() => setOpen((o) => !o)} className="lg:hidden btn btn-ghost !p-2">☰</button>
                </div>
                <nav className={classNames('px-3 pb-4 space-y-1 text-sm', open ? 'block' : 'hidden lg:block')}>
                    {navItems.map((item) => (
                        <Link key={item.route} href={route(item.route)} preserveScroll
                            className={classNames('block px-3 py-2 rounded-lg transition', route().current(item.route + '*') ? 'bg-surface text-text font-medium' : 'text-muted hover:text-text hover:bg-surface')}>
                            {item.label}
                        </Link>
                    ))}
                    <hr className="border-border my-2" />
                    <Link href={route('home')} className="block px-3 py-2 rounded-lg text-muted hover:text-text hover:bg-surface">← Exit admin</Link>
                </nav>
            </aside>

            <div className="flex-1 min-w-0">
                <header className="h-14 border-b border-border surface-2 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-10">
                    <h1 className="font-semibold">{title}</h1>
                    <span className="text-sm text-muted">{auth?.user?.name}</span>
                </header>
                <main className="p-4 sm:p-6 max-w-6xl mx-auto">{children}</main>
            </div>
        </div>
    );
}