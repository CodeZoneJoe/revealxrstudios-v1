export const chunkArray = (array, size) => {
	let result = []
	let arrayCopy = [...array]
	while (arrayCopy.length > 0) {
		result.push(arrayCopy.splice(0, size))
	}
	return result
}

export const inChunk = (value, array, size) => {
	let match = false
	chunkArray(array, size).forEach((chunk, index) => {
		if (chunk.includes(value)) {
			match = index
		}
	})
	return match;
}

export const isDescendant = (parent, child) => {
	let node = child.parentNode;
	while (node != null) {
		if (node == parent) {
			return true;
		}
		node = node.parentNode;
	}
	return false;
}

export const doNotLazyLoad = (img) => {
	img.classList.add('nolazyload')
	img.classList.remove('lazyloading')
	img.classList.add('lazyloaded')
}
