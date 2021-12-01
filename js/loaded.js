export default function loaded(callback) {
	if (document.readyState === 'complete') {
		callback();

	} else {
		document.onreadystatechange = function () {
			if (document.readyState === "complete") {
				callback();

			}
		}
	}
}
