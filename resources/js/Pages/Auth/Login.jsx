import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        login: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'), { onFinish: () => reset('password') });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && <div className="mb-4 text-sm font-medium text-success">{status}</div>}

            <form onSubmit={submit} className="space-y-4">
                <div>
                    <label className="eyebrow" htmlFor="login">Email or Username</label>
                    <input id="login" type="text" name="login" value={data.login} autoFocus required autoComplete="username"
                        onChange={(e) => setData('login', e.target.value)}
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                    {errors.login && <p className="text-sm text-danger mt-1">{errors.login}</p>}
                </div>

                <div>
                    <label className="eyebrow" htmlFor="password">Password</label>
                    <input id="password" type="password" name="password" value={data.password} required autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                        className="mt-1 block w-full surface-2 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand" />
                    {errors.password && <p className="text-sm text-danger mt-1">{errors.password}</p>}
                </div>

                <label className="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="remember" checked={data.remember} onChange={(e) => setData('remember', e.target.checked)} className="rounded text-brand" />
                    Remember me
                </label>

                <div className="flex items-center justify-between">
                    {canResetPassword ? (
                        <Link href={route('password.request')} className="text-sm text-muted underline hover:text-text">Forgot password?</Link>
                    ) : <span />}
                    <button type="submit" className="btn btn-brand" disabled={processing}>Log in</button>
                </div>
            </form>

            <p className="mt-6 text-sm text-muted text-center">
                Don't have an account?{' '}
                <Link href={route('register')} className="text-brand hover:text-brand-strong">Sign up</Link>
            </p>
        </GuestLayout>
    );
}