import './bootstrap';
import 'bootstrap';

const initializeSidebarToggle = () => {
	const sidebar = document.getElementById('sidebar');
	const overlay = document.getElementById('sidebarOverlay');
	const toggleElements = document.querySelectorAll('[data-sidebar-toggle]');

	if (!sidebar || toggleElements.length === 0) {
		return;
	}

	const toggleSidebar = () => {
		sidebar.classList.toggle('active');

		if (overlay) {
			overlay.classList.toggle('active');
		}
	};

	toggleElements.forEach((element) => {
		element.addEventListener('click', toggleSidebar);
	});
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initializeSidebarToggle, { once: true });
} else {
	initializeSidebarToggle();
}
