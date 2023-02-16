import { API_URL } from '$env/static/private';
import { redirect } from '@sveltejs/kit';
import type { Actions, PageServerLoad } from './$types';

export const load = (async ({ fetch, cookies }) => {
	const res = await fetch(`${API_URL}/quotes`, {
		method: 'GET',
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json',
			Authorization: `${cookies.get('token')}`
		}
	});
	const quotes = await res.json();

	return {
		quotes
	};
}) satisfies PageServerLoad;

export const actions = {
	default: async ({ cookies }) => {
		cookies.delete('token');

		throw redirect(303, '/login');
	}
} satisfies Actions;
