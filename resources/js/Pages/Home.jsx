import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ServiceCard from '@/Components/ServiceCard';
import { Link } from '@inertiajs/react';

export default function Home({ services }) {
    return (
        <AuthenticatedLayout>
            <section className="surface-2 relative overflow-hidden">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 py-16 sm:py-24">
                    <p className="eyebrow mb-3">gobanan marketplace</p>
                    <h1 className="text-4xl sm:text-5xl font-bold tracking-tight max-w-2xl leading-tight">
                        Find the right <span className="text-brand">freelance</span> service for your business.
                    </h1>
                    <p className="mt-4 text-lg text-muted max-w-xl">
                        Browse services from vetted sellers across design, development, writing and more.
                    </p>
                    <div className="mt-8 flex flex-wrap gap-3">
                        <Link href={route('explore')} className="btn btn-brand">Explore services</Link>
                        <Link href={route('register')} className="btn btn-ghost">Become a seller</Link>
                    </div>
                </div>
            </section>

            <section className="mx-auto max-w-7xl px-4 sm:px-6 py-12">
                <div className="flex items-end justify-between mb-6">
                    <h2 className="text-2xl font-bold">Featured services</h2>
                    <Link href={route('explore')} className="text-sm text-brand hover:text-brand-strong">View all →</Link>
                </div>

                {services.length === 0 ? (
                    <p className="text-muted">No services yet.</p>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        {services.map((s) => <ServiceCard key={s.id} service={s} />)}
                    </div>
                )}
            </section>
        </AuthenticatedLayout>
    );
}