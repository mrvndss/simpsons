<script>
	import logo from '$lib/images/logo.svg';
	import '../app.postcss';
</script>

<div class="max-w-3xl mx-auto">
	<img src={logo} alt="The Simpsons" />

	<div class="mt-16">
		<slot />
	</div>
</div>
