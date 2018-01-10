window.onload = function() {
	const sidebar = document.getElementById('js--sidebar');
	const tocList = document.getElementById('js--toc-list');
	const items = $(tocList).prop('outerHTML');

	if (!tocList) {
		const echoToc = `<div class="sidebar--item">
			<h5 class="sidebar--title">ページ内目次</h5>
			<nav class="toc--insert">${items}</nav>
		</div>`;
		$(sidebar).prepend(echoToc);
	}
};
