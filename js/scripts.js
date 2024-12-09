jQuery(function ($) {
	$("a:has(img)").addClass("no-icon");
});

// page top scroll
const pagetop_btn = document.querySelector('#page-top');
if (pagetop_btn) {
	pagetop_btn.addEventListener('click', scroll_top);
}
function scroll_top() {
	window.scroll({ top: 0, behavior: 'smooth' });
}

