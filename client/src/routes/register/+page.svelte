<script lang="ts">
	import Alert from '$lib/components/Alert.svelte';
	import Button from '$lib/components/Button.svelte';
	import Input from '$lib/components/Input.svelte';

	export let form;
</script>

<div class="w-80 mx-auto rounded-lg shadow-lg p-8 pb-4">
	<div class="text-center">
		<h1 class="text-2xl font-bold text-gray-800">Register</h1>
	</div>

	<form action="?/register" method="POST" class="mt-6">
		<Input name="name" label="Name" required value={form?.name ?? ''} />
		<Input name="email" type="email" label="E-Mail" required value={form?.email ?? ''} />
		<Input name="password" type="password" label="Password" required value={''} />
		<Input
			name="password_confirmation"
			type="password"
			label="Password Confirmation"
			required
			value={''}
		/>

		{#if form?.errors}
			{#each form.errors as error}
				<Alert text={error.message} />
			{/each}
		{/if}

		<div class="mt-6">
			<Button text="Register" />
		</div>
	</form>

	<a href="/login" class="mt-6 text-center block w-full">
		Already have an account? <br /> Login instead.
	</a>
</div>
