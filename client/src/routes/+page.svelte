<script lang="ts">
	import Button from '$lib/components/Button.svelte';
	import Quote from '$lib/components/Quote.svelte';
	import type { PageData } from './$types';

	export let data: PageData;
</script>

{#each data.quotes as quote}
	<Quote {quote} />
{/each}

<div class="my-10 max-w-xl mx-auto">
	<form method="POST">
		<Button text="Logout" />
	</form>
</div>
