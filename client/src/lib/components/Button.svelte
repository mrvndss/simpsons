<script lang="ts">
	export let text: string;
	export let type: 'submit' | 'button' = 'submit';
</script>

<button {type} class="py-2 bg-simpsons-yellow rounded-lg font-bold w-full">{text}</button>
