import {Controller} from "stimulus"
import {isDescendant} from "../helpers"

export default class extends Controller {
	static targets = ['to']
	handleOutsideClick

	get className() {
		return this.data.get('class')
	}

	get hasClass() {
		return this.toTarget.classList.contains(this.className)
	}

	get toggleOnOutsideClick() {
		return this.data.has('onOutsideClick')
	}

	connect()
	{
		this.handleOutsideClick = (e) => {
			if (!isDescendant(this.element, e.target)) {
				this.remove()
			}
		}
	}


	toggle(e = null) {
		if (e) {
			e.preventDefault()
		}
		if (this.hasClass) {
			this.remove()
		} else {
			this.add()
		}
		return false;
	}

	add(e = null) {
		if (e) {
			e.preventDefault()
		}
		this.toTarget.classList.add(this.className)
		if (this.toggleOnOutsideClick) {
			document.body.addEventListener('click', this.handleOutsideClick, {passive: true})
		}
		return false;
	}

	remove(e = null) {
		if (e) {
			e.preventDefault()
		}
		this.toTarget.classList.remove(this.className)
		if (this.toggleOnOutsideClick) {
			document.body.removeEventListener('click', this.handleOutsideClick, {passive: true})
		}
		return false;
	}
}
