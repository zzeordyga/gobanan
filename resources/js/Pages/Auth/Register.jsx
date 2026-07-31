import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        name: '', username: '', email: '', dob: '', password: '', password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit} className="space-y-4">
                <Field label="Name" error={errors.name}>
                    <input type="text" value={data.name} onChange={(e) => setData('name', e.target.value)} required autoFocus autoComplete="name"
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Username" error={errors.username}>
                    <input type="text" value={data.username} onChange={(e) => setData('username', e.target.value)} required autoComplete="username"
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Email" error={errors.email}>
                    <input type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} required autoComplete="email"
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Date of Birth" error={errors.dob} hint="You must be at least 18 years old.">
                    <input type="date" value={data.dob} onChange={(e) => setData('dob', e.target.value)} required
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Password" error={errors.password}>
                    <input type="password" value={data.password} onChange={(e) => setData('password', e.target.value)} required autoComplete="new-password"
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>
                <Field label="Confirm Password" error={errors.password_confirmation}>
                    <input type="password" value={data.password_confirmation} onChange={(e) => setData('password_confirmation', e.target.value)} required autoComplete="new-password"
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                </Field>

                <div className="flex items-center justify-between pt-2">
                    <Link href={route('login')} className="text-sm text-muted underline hover:text-text">Already registered?</Link>
                    <button type="submit" className="btn btn-brand" disabled={processing}>Register</button>
                </div>
            </form>
        </GuestLayout>
    );
}

function Field({ label, error, hint, children }) {
    return (
        <div>
            <label className="eyebrow">{label}</label>
            {children}
            {hint && <p className="text-xs text-muted mt-1">{hint}</p>}
            {error && <p className="text-sm text-danger mt-1">{error}</p>}
        </div>
    );
}