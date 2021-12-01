import { Controller } from "stimulus"
import {inChunk} from "../helpers";

export default class extends Controller {
	static targets = ['member', 'bio']
	activeClass = 'team-grid__member--active'
	activeMember
	activeBio
	memberBioMap = {}
	memberMap = {}
	handleResize

	/**
	 * The current number of CSS grid columns
	 * @returns {*}
	 */
	get numColumns() {
		return window.getComputedStyle(this.element).gridTemplateColumns.split(' ').length
	}

	/**
	 * Is the drawer currently open?
	 * @returns {boolean}
	 */
	get hasActive() {
		return !!this.activeMember
	}

	/**
	 * We're tracking the targets by WP id. Set that up.
	 */
	connect() {
		this.mapTargets()
		this.handleResize = () => {
			if (this.hasActive) {
				this.refresh()
			}
		}
		window.addEventListener('resize', this.handleResize, {passive: true});
	}

	refresh() {
		const member = this.activeMember
		this.closeMember()
		this.openMember(member)
	}

	/**
	 * Get the ID from the dataset to create a map of members and bios.
	 */
	mapTargets() {
		this.memberTargets.forEach(member => {
			const bio = member.querySelector('.team-grid__member-bio')
			bio.classList.remove('hidden')
			this.memberMap[member.dataset.memberId] = member
			this.memberBioMap[member.dataset.memberId] = bio
			bio.remove()
		})
	}

	/**
	 * The open event
	 * @param e
	 */
	open(e) {
		e.preventDefault()
		this.openMember(
			this.findMember(e.currentTarget.dataset.memberId)
		)
	}

	/**
	 * The close event
	 * @param e
	 */
	close(e) {
		e.preventDefault()
		this.closeMember()
	}

	/**
	 * Close the current member.
	 */
	closeMember() {
		if (this.hasActive) {
			this.activeBio.remove()
			this.activeBio = null
			this.activeMember = null
		}
		this.render()
	}

	/**
	 * Open a  member.
	 * @param member
	 */
	openMember(member) {
		if (this.activeMember === member) {
			return
		}

		this.closeMember()

		this.activeMember = member
		this.activeBio = this.findMemberBio(member.dataset.memberId)
		this.element.classList.add(this.activeClass)
		this.render()
	}

	/**
	 * Find a bio by member ID from the map
	 * @param id
	 * @returns {*}
	 */
	findMemberBio(id) {
		return this.memberBioMap[id]
	}

	/**
	 * Find a member by ID from the map
	 * @param id
	 * @returns {*}
	 */
	findMember(id) {
		return this.memberMap[id]
	}

	/**
	 * Calculate the element position of the bio. It will go at the end of a grid row.
	 * @param id
	 * @returns {number}
	 */
	calculateBioPosition(id) {
		const numCols = this.numColumns
		let inRow = inChunk(id, this.memberTargets.map((member) => member.dataset.memberId), numCols)
		if (inRow === false) {
			return;
		}
		inRow++
		return numCols * inRow
	}

	/**
	 * Render the current state
	 */
	render() {
		this.memberTargets.forEach((member) => {
			if (member !== this.activeMember) {
				member.classList.remove(this.activeClass)
			} else {
				member.classList.add(this.activeClass)
			}
		})
		if (this.hasBioTarget) {
			this.bioTargets.forEach((bio) => {
				if (bio !== this.activeBio) {
					bio.remove()
				}
			})
		}
		if (this.hasActive) {
			if (!this.hasBioTarget) {
				this.renderBio(this.activeBio)
			}
			this.element.classList.add(this.activeClass)
		} else {
			this.element.classList.remove(this.activeClass)
		}
	}

	/**
	 * Render the bio in the current state.
	 */
	renderBio() {
		if (!this.activeMember) {
			return
		}
		const position = this.calculateBioPosition(this.activeMember.dataset.memberId)
		const afterPosition = position - 1
		let afterEl
		if (this.memberTargets[afterPosition]) {
			afterEl = this.memberTargets[afterPosition]
		} else {
			afterEl = this.memberTargets[this.memberTargets.length - 1]
		}
		this.activeBio.style.setProperty('--team-grid-span', `1/span ${this.numColumns}`)
		afterEl.after(this.activeBio)
	}
}
