<script lang="ts">
	import Alert from '$lib/components/Alert.svelte';
	import Button from '$lib/components/Button.svelte';
	import Input from '$lib/components/Input.svelte';

	export let form;
</script>

<div class="w-80 mx-auto rounded-lg shadow-lg p-8 pb-4">
	<div class="text-center">
		<h1 class="text-2xl font-bold text-gray-800">Login</h1>
	</div>

	<form method="POST" class="mt-6">
		<Input name="email" type="email" label="E-Mail" required value={form?.email ?? ''} />
		<Input name="password" type="password" label="Password" required value={form?.password ?? ''} />

		{#if form?.error}
			<Alert text={form.error} />
		{/if}

		<div class="mt-6">
			<Button text="Login" />
		</div>
	</form>

	<a href="/register" class="mt-6 text-center block w-full">
		Don't have an account? <br /> Register now!
	</a>
</div>
