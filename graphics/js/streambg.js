let animationSpeed = 0.004;
let animationScale = 0.01;
let animationScale2 = 0.01;
let disarray = 10;

let lightRadius = 1;

class Cube {
	constructor(x, y, z, w) {
		this.geometry = new THREE.BoxBufferGeometry(w, w, w);

		this.material = new THREE.MeshStandardMaterial({
			color: 0xaaaaaa,
			wireframe: false,
			emissive: 0x333333,
		});

		this.obj = new THREE.Mesh(this.geometry, this.material);
		this.obj.position.x = x;
		this.obj.position.y = y;
		this.obj.position.z = z;

		this.obj.castShadow = true;
		this.obj.receiveShadow = true;

		// run the function to determine whether the cube should move up or down
		this.dirGen();

		this.animationScale = animationScale += Math.random() * animationScale2;

		this.animationShift = Math.random() * disarray;
	}

	// animation function for the single cube
	animate(framestep) {
		let add =
			Math.sin(framestep + this.animationShift) *
			animationSpeed *
			this.animationScale *
			this.direction;
		this.obj.position.z += add;
	}

	// function that determines the direction the cube should move in
	dirGen() {
		let a = Math.round(Math.random());
		if (a === 1) {
			this.direction = 1;
		} else {
			this.direction = -1;
		}
	}
}

class SpotLight {
	constructor(x, y) {
		this.light = new THREE.PointLight(0xffffff, lightRadius, 120);
		this.light.position.set(x, y, 80);
		this.light.castShadow = true;

		scene.add(this.light);
	}
}

class CubeArray {
	constructor(x, y, w) {
		let xshift = Math.round(x / 2);
		let yshift = Math.round(y / 2);

		this.arr = [];

		for (let i = -xshift; i <= xshift; i++) {
			for (let j = -yshift; j <= yshift; j++) {
				let x = i * w;
				let y = j * w;
				let z = 0;

				this.arr.push(new Cube(x, y, z, w));
			}
		}

		for (let k = 0; k < this.arr.length; k++) {
			scene.add(this.arr[k].obj);
		}
	}

	animate(framestep) {
		for (let k = 0; k < this.arr.length; k++) {
			this.arr[k].animate(framestep);
		}
	}
}

// set up the scene, camera and renderer
let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(
	75,
	window.innerWidth / window.innerHeight,
	0.1,
	1000
);
camera.position.z = 100;

let renderer = new THREE.WebGLRenderer({
	antialias: true,
	alpha: true,
});

// set the render settings enable and pick shadow map
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCMSoftShadowMap;

// attach the renderer to the background div
document.getElementById("background").appendChild(renderer.domElement);

// add some nice lights
var spot1 = new SpotLight(-70, -40);
var spot2 = new SpotLight(70, -40);
var spot3 = new SpotLight(-70, 50);
var spot4 = new SpotLight(70, 50);

let boxes = new CubeArray(40, 40, 15);

let framestep = 0;

// add a background plane
var bg = new THREE.PlaneGeometry(500, 500);
var bgMat = new THREE.MeshBasicMaterial({ color: 0x666666 });
var bgplane = new THREE.Mesh(bg, bgMat);

bgplane.position.z = -100;
scene.add(bgplane);

function animate() {
	requestAnimationFrame(animate);
	renderer.render(scene, camera);
	boxes.animate(framestep);
	if (framestep <= 1000) {
		framestep += animationSpeed;
	} else {
		framestep = 0;
	}
}
animate();
