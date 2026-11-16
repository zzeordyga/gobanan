import { Link, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import Dropdown from '@/Components/Dropdown';

function useTheme() {
    const [dark, setDark] = useState(false);

    useEffect(() => {
        setDark(document.documentElement.classList.contains('dark'));
    }, []);

    const toggle = () => {
        setDark((d) => {
            const next = !d;
            document.documentElement.classList.toggle('dark', next);
            try {
                localStorage.setItem('theme', next ? 'dark' : 'light');
            } catch (e) {}
            return next;
        });
    };

    return { dark, toggle };
}

function classNames(...c) {
    return c.filter(Boolean).join(' ');
}

export default function AuthenticatedLayout({ children }) {
    const { auth } = usePage().props;
    const user = auth?.user ?? null;
    const [open, setOpen] = useState(false);
    const { dark, toggle } = useTheme();

    return (
        <div className="min-h-screen bg-bg text-text flex flex-col">
            <header className="sticky top-0 z-40 surface-2 backdrop-blur supports-[backdrop-filter]:bg-[var(--surface-2)]/80">
                <div className="mx-auto max-w-7xl px-4 sm:px-6">
                    <div className="flex h-16 items-center gap-3">
                        <Link href={route('home')} className="flex items-center gap-2 font-bold tracking-tight">
                            <span className="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-brand text-white font-black">g</span>
                            <span className="hidden sm:inline">gobanan</span>
                        </Link>

                        <form action={route('search')} method="GET" className="flex-1 max-w-xl mx-auto">
                            <div className="relative">
                                <svg className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth="2" d="m21 21-4.3-4.3M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z" /></svg>
                                <input type="text" name="keyword" placeholder="Search services, sellers, categories…"
                                    className="w-full surface-2 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand" />
                            </div>
                        </form>

                        <nav className="hidden md:flex items-center gap-1 text-sm">
                            <Link href={route('explore')} className={classNames('px-3 py-2 rounded-lg transition', route().current('explore*') ? 'text-brand font-medium' : 'text-muted hover:text-text hover:bg-surface-2')}>Explore</Link>
                            {user && <>
                                <Link href={route('cart.index')} className={classNames('px-3 py-2 rounded-lg transition', route().current('cart.*') ? 'text-brand font-medium' : 'text-muted hover:text-text hover:bg-surface-2')}>Cart</Link>
                                <Link href={route('orders')} className={classNames('px-3 py-2 rounded-lg transition', route().current('orders') ? 'text-brand font-medium' : 'text-muted hover:text-text hover:bg-surface-2')}>Orders</Link>
                                <Link href={route('services.create')} className={classNames('px-3 py-2 rounded-lg transition', route().current('services.create') ? 'text-brand font-medium' : 'text-muted hover:text-text hover:bg-surface-2')}>Sell</Link>
                                {user.role === 'admin' && <Link href={route('admin.index')} className="px-3 py-2 rounded-lg text-accent hover:text-text hover:bg-surface-2 transition">Admin</Link>}
                            </>}
                        </nav>

                        <button onClick={toggle} title={dark ? 'Light mode' : 'Dark mode'}
                            className="inline-flex h-9 w-9 items-center justify-center rounded-lg surface-2 text-text hover:text-brand transition">
                            {dark ? (
                                <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth="2" d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" /></svg>
                            ) : (
                                <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.36 6.36-.7-.7M6.34 6.34l-.7-.7m12.72 0-.7.7M6.34 17.66l-.7.7M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" /></svg>
                            )}
                        </button>

                        {user ? (
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <button className="inline-flex items-center gap-2 surface-2 rounded-full p-1 pr-2 text-sm hover:text-brand transition">
                                        <span className="inline-flex h-7 w-7 items-center justify-center rounded-full bg-brand text-white text-xs font-bold">{user.name.charAt(0).toUpperCase()}</span>
                                        <span className="hidden sm:inline">{user.name}</span>
                                    </button>
                                </Dropdown.Trigger>
                                <Dropdown.Content>
                                    <Dropdown.Link href={route('profile.edit')}>Profile</Dropdown.Link>
                                    <Dropdown.Link href={route('orders')}>My orders</Dropdown.Link>
                                    <Dropdown.Link href={route('logout')} method="post" as="button">Log Out</Dropdown.Link>
                                </Dropdown.Content>
                            </Dropdown>
                        ) : (
                            <div className="hidden sm:flex items-center gap-2">
                                <Link href={route('login')} className="btn btn-ghost text-sm">Log in</Link>
                                <Link href={route('register')} className="btn btn-brand text-sm">Sign up</Link>
                            </div>
                        )}

                        <button onClick={() => setOpen((o) => !o)} className="md:hidden inline-flex h-9 w-9 items-center justify-center rounded-lg surface-2">
                            <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                    </div>
                </div>

                {open && (
                    <div className="md:hidden border-t border-border surface px-4 py-3 space-y-1 text-sm">
                        <Link href={route('explore')} className="block px-3 py-2 rounded-lg hover:bg-surface-2">Explore</Link>
                        {user ? <>
                            <Link href={route('cart.index')} className="block px-3 py-2 rounded-lg hover:bg-surface-2">Cart</Link>
                            <Link href={route('orders')} className="block px-3 py-2 rounded-lg hover:bg-surface-2">Orders</Link>
                            <Link href={route('services.create')} className="block px-3 py-2 rounded-lg hover:bg-surface-2">Sell a service</Link>
                            {user.role === 'admin' && <Link href={route('admin.index')} className="block px-3 py-2 rounded-lg text-accent">Admin</Link>}
                            <Link href={route('profile.edit')} className="block px-3 py-2 rounded-lg hover:bg-surface-2">Profile</Link>
                            <Link href={route('logout')} method="post" as="button" className="block px-3 py-2 rounded-lg text-danger hover:bg-surface-2">Log Out</Link>
                        </> : (
                            <div className="flex gap-2 pt-2">
                                <Link href={route('login')} className="btn btn-ghost flex-1">Log in</Link>
                                <Link href={route('register')} className="btn btn-brand flex-1">Sign up</Link>
                            </div>
                        )}
                    </div>
                )}
            </header>

            {usePage().props.flash?.status && (
                <div className="mx-auto max-w-7xl px-4 sm:px-6 mt-4">
                    <div className="surface-2 px-4 py-3 text-sm text-success">{usePage().props.flash.status}</div>
                </div>
            )}

            <main className="flex-1">{children}</main>

            <footer className="border-t border-border surface mt-12">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 py-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm text-muted">
                    <p>© {new Date().getFullYear()} gobanan — freelance marketplace.</p>
                    <nav className="flex gap-4">
                        <Link href={route('explore')} className="hover:text-text">Explore</Link>
                        <Link href={route('search', { keyword: 'design' })} className="hover:text-text">Trending</Link>
                    </nav>
                </div>
            </footer>
        </div>
    );
}