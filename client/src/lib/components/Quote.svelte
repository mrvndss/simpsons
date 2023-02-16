<script lang="ts">
	import type { Quote } from '../../types';

	export let quote: Quote;
</script>

<div
	class={`my-4 flex justify-between ${quote.characterDirection == 'Left' && 'flex-row-reverse'}`}
>
	<div class="flex justify-center flex-col">
		<p class="text-2xl font-bold text-gray-800">{quote.quote}</p>
		<p class="text-gray-600 italic">{quote.character}</p>
	</div>
	<img src={quote.image} alt={quote.character} width="200" height="200" />
</div>
