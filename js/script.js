//window.alert('Hello Word');
function informando(){
    window.alert("Em Breve");
}
document.addEventListener("DOMContentLoaded", () => {
	let progress = 0,
	incrementSpeed = 4,
	progressBar = document.getElementById('bar'),
	progressInterval = setInterval( () => {
		progress += incrementSpeed;
		progressBar.value = progress;

		if(progress >= 100){
			clearInterval(progressInterval);
		}
	},100);
});
