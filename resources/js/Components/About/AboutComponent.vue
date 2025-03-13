<template>
    <section class="py-5">
	<div class="container">
		<div class="row gx-4 align-items-center justify-content-between">
			<div class="col-md-5 order-2 order-md-1">
				<div class="mt-5 mt-md-0">
					
					<h2 class="display-5 fw-bold border-bottom border-4 border-primary d-inline">{{ page.props.list.title? page.props.list.title : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.' }}</h2>
					<p class="lead mt-3">{{ page.props.list.long_des? page.props.list.long_des : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.' }}</p>
				</div>
			</div>
			<div class="col-md-6 offset-md-1 order-1 order-md-2">
				<div class="row gx-2 gx-lg-3">
					<div class="col-6">
						<div class="mb-2"><img class="img-fluid rounded-3" :src="page.props.list.image1? page.props.list.image1 : '/dashboard/assets/img/no-book.jpg'"></div>
					</div>
					<div class="col-6">
						<div class="mb-2"><img class="img-fluid rounded-3" :src="page.props.list.image2? page.props.list.image2 : '/dashboard/assets/img/no-book.jpg'"></div>
					</div>
					<div class="col-6">
						<div class="mb-2"><img class="img-fluid rounded-3" :src="page.props.list.image3? page.props.list.image3 : '/dashboard/assets/img/no-book.jpg'"></div>
					</div>
					<div class="col-6">
						<div class="mb-2"><img class="img-fluid rounded-3" :src="page.props.list.image4? page.props.list.image4 : '/dashboard/assets/img/no-book.jpg'"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();

</script>

<style scoped>

</style>