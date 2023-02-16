import { API_URL } from '$env/static/private';
import { redirect, type Handle } from '@sveltejs/kit';

export const handle = (async ({ event, resolve }) => {
	if (event.url.pathname == '/') {
		// if cookie is not set or is invalid, redirect to login page
		if (!event.cookies.get('token')) {
			throw redirect(303, '/login');
		}

		const token = event.cookies.get('token');
		const res = await fetch(`${API_URL}/token/${token}`);

		if (res.status != 200) {
			event.cookies.delete('token');
			throw redirect(303, '/login');
		}
	}

	const response = await resolve(event);
	return response;
}) satisfies Handle;
