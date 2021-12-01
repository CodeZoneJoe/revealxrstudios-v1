import {doNotLazyLoad} from "./helpers";
import Typed from 'typed.js'

// TODO: THEME
export default function (root) {
	root.querySelectorAll('body').forEach(el => {
		el.classList.add('ready')
	})

	root.querySelectorAll('.rotating-headline').forEach(el => {
		const wordsEl = el.querySelector('em')
		if (!wordsEl) {
			return
		}


		const text = wordsEl.textContent;
		wordsEl.innerHTML = ''

		const words = text.split(',').map(part => part.trim(' '));

		new Typed(wordsEl, {
			strings: words,
			typeSpeed: 100,
			backSpeed: 30,
			loop: true,
			showCursor: false,
			backDelay: 1500
		});

		el.style.visibility = 'visible'
		el.style.display = 'block'
		el.style.height = 'initial'
	})

	root.querySelectorAll('.swiper-slide img').forEach(doNotLazyLoad)
}

