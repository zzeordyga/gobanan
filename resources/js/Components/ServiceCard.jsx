import { Link } from '@inertiajs/react';

export default function ServiceCard({ service }) {
    const picture = service.picture || `https://images.unsplash.com/photo-1521737604893-d14cc2376112?w=600&q=70&auto=format`;
    const seller = service.seller;
    const count = service.reviewCount;
    const rating = service.rating;

    return (
        <Link href={route('services.show', service.id)} preserveScroll
            className="group surface overflow-hidden flex flex-col transition hover:shadow-lg hover:-translate-y-0.5">
            <div className="aspect-[16/10] bg-surface-2 overflow-hidden">
                <img src={picture} alt={service.name} loading="lazy" decoding="async"
                    className="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
            </div>
            <div className="p-4 flex flex-col gap-3 flex-1">
                <div className="flex items-center gap-2 text-sm">
                    {seller && (
                        <span className="inline-flex items-center gap-2">
                            <span className="inline-flex h-6 w-6 items-center justify-center rounded-full bg-accent text-white text-xs font-bold">
                                {seller.name?.charAt(0).toUpperCase()}
                            </span>
                            <span className="text-muted">{seller.name}</span>
                        </span>
                    )}
                    {service.category && <span className="ml-auto eyebrow">{service.category.name}</span>}
                </div>

                <h3 className="font-semibold leading-snug line-clamp-2 group-hover:text-brand transition">{service.name}</h3>

                <div className="mt-auto flex items-center justify-between">
                    <div className="flex items-center gap-1 text-sm">
                        <svg className="h-4 w-4 text-accent" fill="currentColor" viewBox="0 0 20 20"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.36 4.17h4.38c.97 0 1.37 1.24.59 1.81l-3.55 2.58 1.36 4.17c.3.92-.76 1.69-1.54 1.12L10 16.2l-3.55 2.58c-.78.57-1.84-.2-1.54-1.12l1.36-4.17-3.55-2.58c-.78-.57-.38-1.81.59-1.81h4.38l1.36-4.17z" /></svg>
                        {count > 0 ? (
                            <><span className="font-medium">{rating.toFixed(1)}</span><span className="text-muted">({count})</span></>
                        ) : <span className="text-muted">New</span>}
                    </div>
                    <span className="text-lg font-bold">from <span className="text-brand">${Number(service.price).toFixed(2)}</span></span>
                </div>
            </div>
        </Link>
    );
}