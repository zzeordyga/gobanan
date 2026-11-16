import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    return (
        <div className="flex min-h-screen flex-col items-center bg-bg text-text pt-6 sm:justify-center sm:pt-0">
            <Link href="/" className="flex items-center gap-2 font-bold mb-6">
                <span className="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-brand text-white font-black text-lg">g</span>
                <span className="text-xl">gobanan</span>
            </Link>
            <div className="mt-2 w-full overflow-hidden surface shadow-md sm:max-w-md sm:rounded-lg px-6 py-8">
                {children}
            </div>
        </div>
    );
}