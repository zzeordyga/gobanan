import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ServiceCard from '@/Components/ServiceCard';
import { Link } from '@inertiajs/react';

export default function Explore({ services, categories, currentCategory }) {
    return (
        <AuthenticatedLayout>
            <div className="mx-auto max-w-7xl px-4 sm:px-6 py-8">
                <div className="flex flex-col lg:flex-row gap-8">
                    <aside className="lg:w-56 shrink-0">
                        <h2 className="eyebrow mb-3">Categories</h2>
                        <div className="lg:sticky lg:top-20 flex lg:flex-col gap-2 overflow-x-auto lg:overflow-x-visible pb-2 lg:pb-0 -mx-4 px-4 lg:mx-0 lg:px-0">
                            <Link href={route('explore')} preserveScroll
                                className={`shrink-0 lg:w-full px-3 py-2 rounded-lg text-sm whitespace-nowrap transition ${!currentCategory ? 'bg-brand text-white' : 'surface-2 text-text hover:text-brand'}`}>
                                All
                            </Link>
                            {categories.map((c) => (
                                <Link key={c.id} href={route('category', c.id)} preserveScroll
                                    className={`shrink-0 lg:w-full px-3 py-2 rounded-lg text-sm whitespace-nowrap transition ${currentCategory?.id === c.id ? 'bg-brand text-white' : 'surface-2 text-text hover:text-brand'}`}>
                                    {c.name}
                                </Link>
                            ))}
                        </div>
                    </aside>

                    <div className="flex-1">
                        <div className="flex items-center justify-between mb-5">
                            <h1 className="text-2xl font-bold">{currentCategory ? currentCategory.name : 'Explore'}</h1>
                            <span className="text-sm text-muted">{services.total} results</span>
                        </div>

                        {services.data.length === 0 ? (
                            <div className="surface p-10 text-center">
                                <p className="text-muted">No services found in this category.</p>
                            </div>
                        ) : (
                            <>
                                <div className="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                                    {services.data.map((s) => <ServiceCard key={s.id} service={s} />)}
                                </div>
                                <Pagination paginator={services} />
                            </>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

function Pagination({ paginator }) {
    if (paginator.last_page <= 1) return null;
    const pages = Array.from({ length: paginator.last_page }, (_, i) => i + 1);
    const link = (p) => `${paginator.path}?page=${p}`;
    return (
        <nav className="mt-8 flex flex-wrap justify-center gap-1">
            {paginator.current_page > 1 && (
                <a href={link(paginator.current_page - 1)} className="px-3 py-2 surface-2 rounded-lg text-sm hover:text-brand">←</a>
            )}
            {pages.map((p) => (
                <a key={p} href={link(p)} className={`px-3 py-2 rounded-lg text-sm ${p === paginator.current_page ? 'bg-brand text-white' : 'surface-2 hover:text-brand'}`}>{p}</a>
            ))}
            {paginator.current_page < paginator.last_page && (
                <a href={link(paginator.current_page + 1)} className="px-3 py-2 surface-2 rounded-lg text-sm hover:text-brand">→</a>
            )}
        </nav>
    );
}