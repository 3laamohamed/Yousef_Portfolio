'use strict';

$(document).ready(function () {
	let fixed = true;
	function getScroll() {
		if (window.scrollY > 50) {
			if (fixed) {
				$('nav.navbar').addClass('fixed-top nav-fixed');
				fixed = false;
			}
		} else {
			$('nav.navbar').removeClass('fixed-top nav-fixed');
			fixed = true;
		}
	}

	$(window).on('scroll', getScroll);
	getScroll();

	$('.category').click(function () {
		$(this).addClass('active').siblings().removeClass('active');

		let filter = $(this).attr('data-filter');

		if (filter == 'all') {
			$('.cards').show(500);
		} else {
			$('.cards')
				.not('.' + filter)
				.hide(400);
			$('.cards')
				.filter('.' + filter)
				.show(500);
		}
	});
});

const projectModal = document.getElementById('project_modal');
projectModal.addEventListener('show.bs.modal', (event) => {
	const button = event.relatedTarget;
});
