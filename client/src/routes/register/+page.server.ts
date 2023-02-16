import { API_URL } from '$env/static/private';
import { redirect } from '@sveltejs/kit';
import type { Actions } from './$types';

export const actions = {
	register: async ({ request, cookies }) => {
		const data = await request.formData();

		// use api endpoint to register user
		const res = await fetch(`${API_URL}/register`, {
			method: 'POST',
			body: data
		});

		// if registration was not successful, return error message
		if (!res.ok) {
			const errorResponse = await res.json();

			const errors = Object.entries(errorResponse).map(([key, value]) => {
				return {
					field: key,
					message: value[0]
				};
			});

			return {
				errors,
				email: data.get('email'),
				name: data.get('name')
			};
		}

		// otherwise, log user in and redirect to home page
		const { user } = await res.json();
		cookies.set('token', user.api_token);

		throw redirect(303, '/');
	}
} satisfies Actions;
