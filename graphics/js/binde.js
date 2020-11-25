// set up variables for easy access and configuration
let mainPlaneColor = 0x000000;
let mainPlaneTransparency = 0.4;

let textLightColor = 0xff4400;
let textLightColor2 = 0x00aaff;

// animation constants
let textLightSpeed = 0.005;

// coordinate positions
const maxWidth = 14;

// positions for the main plane vectors
let bottomLeft = -7.25;
let widthLeft = 2;
let bottomRight = -6.8;
let widthRight = 2.5;

let bgVectors = [
	[-maxWidth, bottomLeft], // bottom left
	[-maxWidth, bottomLeft + widthLeft], // top left
	[maxWidth, bottomRight], // bottom right
	[maxWidth, bottomRight + widthRight], // top right
];

let bgHeight = 0;

// positions for the text
let textHeight = 1;
let textCoords = [4, -4];

// set up the scene, camera and renderer
let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(
	75,
	window.innerWidth / window.innerHeight,
	0.1,
	1000
);
camera.position.z = 10;

let renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });

// set the render settings enable and pick shadow map
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFShadowMap;

// attach the renderer to the background div
document.getElementById("background").appendChild(renderer.domElement);

// add the relevant geometry

// ###############################
// Main Plane
// ###############################

// add the vertices
var mainPlaneGeometry = new THREE.Geometry();

mainPlaneGeometry.vertices.push(
	new THREE.Vector3(bgVectors[0][0], bgVectors[0][1], bgHeight), // bottom left vertex
	new THREE.Vector3(bgVectors[1][0], bgVectors[1][1], bgHeight), // top left vertex
	new THREE.Vector3(bgVectors[2][0], bgVectors[2][1], bgHeight), // top left vertex
	new THREE.Vector3(bgVectors[3][0], bgVectors[3][1], bgHeight) // top right vertex
);

// create faces from the vertices
mainPlaneGeometry.faces.push(
	new THREE.Face3(2, 1, 0),
	new THREE.Face3(3, 1, 2)
);

mainPlaneGeometry.computeFaceNormals();
mainPlaneGeometry.computeVertexNormals();

// define the material, create the plane and add it to the scene
var mainPlaneMaterial = new THREE.MeshStandardMaterial({
	color: mainPlaneColor,
	wireframe: false,
	transparent: true,
	opacity: mainPlaneTransparency,
});
mainPlaneMaterial.ambient = mainPlaneMaterial.color;
var mainPlane = new THREE.Mesh(mainPlaneGeometry, mainPlaneMaterial);

mainPlane.castShadow = true;
mainPlane.receiveShadow = true;

scene.add(mainPlane);

// Set up Lighting

var textLight = new THREE.PointLight(textLightColor, 30, 100000);
textLight.position.set(4, -8, 2);
textLight.castShadow = true;

scene.add(textLight);

var textLight2 = new THREE.PointLight(textLightColor2, 30, 100000);
textLight2.position.set(-4, -9, 2);
textLight2.castShadow = true;

scene.add(textLight2);

let moTeLi = 0;

function animate() {
	requestAnimationFrame(animate);
	moveTextLight();
	renderer.render(scene, camera);
}
animate();

// make the content resize with the window size
// makes the entire thing unrelevant to the actual size in obs
window.addEventListener("resize", onWindowResize, false);

function onWindowResize() {
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();

	renderer.setSize(window.innerWidth, window.innerHeight);
}

function moveTextLight() {
	textLight.translateX(Math.sin(moTeLi) * textLightSpeed * 10);
	textLight2.translateX(-(Math.cos(moTeLi) * textLightSpeed * 10));
	moTeLi += textLightSpeed;
}
