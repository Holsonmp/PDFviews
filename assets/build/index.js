const pdf =  dtx_config.base_url + "uploads/digital-files/" + dtx_config.files;
const initialState = {
	pdfDoc: null,
	currentPage: 1,
	pageCount: 0,
	zoom: 1,
};

const renderPage = () => {
	initialState.pdfDoc.getPage(initialState.currentPage).then((page) => {
		const canvas = document.querySelector("#canvas");
		const ctx = canvas.getContext("2d");
		const viewport = page.getViewport({ scale: initialState.zoom });

		canvas.height = viewport.height;
		canvas.width = viewport.width;
		const renderCtx = {
			canvasContext: ctx,
			viewport: viewport,
		};

		page.render(renderCtx);
		pageNum.textContent = initialState.currentPage;
	});
};

pdfjsLib
	.getDocument(pdf)
	.promise.then((data) => {
		initialState.pdfDoc = data;
		// console.log("pdfDocument", initialState.pdfDoc);

		pageCount.textContent = initialState.pdfDoc.numPages;

		renderPage();
	})
	.catch((err) => {
		alert(err.message);
	});

	const showPrevPage = () => {
		if (initialState.pdfDoc === null || initialState.currentPage <= 1) return;
		initialState.currentPage--;
		currentPage.value = initialState.currentPage;
		renderPage();
	};

	const showNextPage = () => {
		if (
			initialState.pdfDoc === null ||
			initialState.currentPage >= initialState.pdfDoc._pdfInfo.numPages
		)
			return;

		initialState.currentPage++;
		currentPage.value = initialState.currentPage;
		renderPage();
	};


	previousPage.addEventListener("click", showPrevPage);
	nextPage.addEventListener("click", showNextPage);

	currentPage.addEventListener("keypress", (event) => {
	if (initialState.pdfDoc === null) return;
	const keycode = event.keyCode ? event.keyCode : event.which;
	if (keycode === 13) {
		let desiredPage = currentPage.valueAsNumber;
		initialState.currentPage = Math.min(
		Math.max(desiredPage, 1),
		initialState.pdfDoc._pdfInfo.numPages
		);
		currentPage.value = initialState.currentPage;
		renderPage();
	}
	});

// Zoom Events
const zoomLevel = document.querySelector("#zoom-level");
zoomIn.addEventListener("click", () => {
	if (initialState.pdfDoc === null) return;
	initialState.zoom *= 4 / 3;
	// zoomLevel.textContent = Math.round(initialState.zoom * 100) + "%";
	renderPage();
});

zoomOut.addEventListener("click", () => {
	if (initialState.pdfDoc === null) return;
	initialState.zoom *= 2 / 3;
	// zoomLevel.textContent = Math.round(initialState.zoom * 100) + "%";
	renderPage();
});


// Key Events
document.addEventListener("keydown", (event) => {
  if (event.key === "ArrowLeft") showPrevPage();
  if (event.key === "ArrowRight") showNextPage();
});
/*
printButton.addEventListener("click", () => {
  // window.print();
  printJS("canvas", "html");
});
*/