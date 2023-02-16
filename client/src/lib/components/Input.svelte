<script lang="ts">
	export let value: string;
	export let required: boolean = false;
	export let name: string;
	export let type: string = 'text';
	export let label: string;

	function typeAction(node: HTMLInputElement) {
		node.type = type;
	}
</script>

<div class="my-2">
	<label for={name} class="block text-gray-800 font-bold">{label}</label>
	<input
		use:typeAction
		{name}
		id={name}
		class="w-full px-4 py-3 rounded-lg bg-gray-100 border-gray-200 mt-2"
		bind:value
		{required}
	/>
</div>
