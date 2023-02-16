import { API_URL } from '$env/static/private';
import { redirect } from '@sveltejs/kit';
import type { Actions } from './$types';

export const actions = {
	default: async ({ request, cookies }) => {
		const data = await request.formData();

		const res = await fetch(`${API_URL}/login`, {
			method: 'POST',
			body: data
		});

		if (!res.ok) {
			const { message } = await res.json();
			return {
				error: message,
				email: data.get('email')
			};
		}

		const { user } = await res.json();
		cookies.set('token', user.api_token);

		throw redirect(303, '/');
	}
} satisfies Actions;
