// JavaScript Document

const canvas = document.getElementById("app_canvas");
const ctx = canvas.getContext('2d');
canvas.width = document.getElementById("app_canvas").offsetWidth;
canvas.height = document.getElementById("app_canvas").offsetHeight;

let particlesArray;
let numPlanets = 25;
let G = 1e-3;

let decay = 1.0;

class Vector
{
	constructor(dx, dy)
	{
		this.dx = dx;
		this.dy = dy;
	}
}
const toLeft = new Vector(-1, 0);
const toRight = new Vector(1, 0);
const toTop = new Vector(0, -1);
const toBottom = new Vector(0, 1);

class Planet
{
	constructor(name, pos, vel, mass, radius, color)
	{
		this.name = name;
		this.pos = pos;
		this.vel = vel;
		this.acc = new Vector(0, 0);
		this.mass = mass;
		this.radius = radius;
		this.color = color;
		
		this.forces = [];
	}
	
	draw()
	{
		ctx.beginPath();
		ctx.arc(this.pos.dx, this.pos.dy, this.radius*2, 0, Math.PI * 2, false);
		ctx.fillStyle = this.color;
		ctx.fill();
	}
	update()
	{
		if(this.pos.dx > canvas.width - this.radius)
		{
			this.forces.push(toLeft);
			this.vel.dx *= decay;
			this.vel.dy *= decay;
		}
		if(this.pos.dx < this.radius)
		{
			this.forces.push(toRight);
			this.vel.dx *= decay;
			this.vel.dy *= decay;
		}
		if(this.pos.dy > canvas.height - this.radius)
		{
			this.forces.push(toTop);
			this.vel.dx *= decay;
			this.vel.dy *= decay;
		}
		if(this.pos.dy < this.radius)
		{
			this.forces.push(toBottom);
			this.vel.dx *= decay;
			this.vel.dy *= decay;
		}
		
		for(let i = this.forces.length-1; i > 0; i--)
		{
			this.vel.dx += this.forces[i].dx;
			this.vel.dy += this.forces[i].dy;
			this.forces.pop();
		}
		//this.vel.dx *= decay;
		//this.vel.dy *= decay;
		this.pos.dx += this.vel.dx;
		this.pos.dy += this.vel.dy;
		
		this.draw();
	}
}

function initForms()
{
	// Gravity Toggle
	
	// G Value
	adjustG(5e5);
	//Decay Value
	adjustDecay(100);
	// Num Planets
	
}
function init()
{
	initForms();
	particlesArray = [];
	
	for(let i = 0; i < numPlanets; i++)
	{
		planetIncrement();
	}
}

function pull()
{
	let distance = 10;
	for(let a = 0; a < particlesArray.length-1; a++)
	{
		for(let b = a+1; b < particlesArray.length; b++)
		{
			let x1 = particlesArray[a].pos.dx;
			let x2 = particlesArray[b].pos.dx;
			let y1 = particlesArray[a].pos.dy;
			let y2 = particlesArray[b].pos.dy;
			// Calculate distance between bodies
			distance = Math.sqrt((x2-x1)*(x2-x1)+(y2-y1)*(y2-y1));
			if(distance < 10)
			{
				distance = 10;
			}
			// Calculate Gravitational Force scalar
			let forceG = G * ((particlesArray[a].mass * particlesArray[b].mass)/(distance*distance));
			
			// Calculate normalized direction vector (unit vector)
			let uAB = new Vector((x2-x1)/distance, (y2-y1)/distance);
			let uBA = new Vector(-uAB.dx, -uAB.dy);
			// Update velocity vectors of each body
			particlesArray[a].forces.push(new Vector(forceG*uAB.dx/particlesArray[a].mass, forceG*uAB.dy/particlesArray[a].mass));
			particlesArray[b].forces.push(new Vector(forceG*uBA.dx/particlesArray[b].mass, forceG*uBA.dy/particlesArray[b].mass));
		}
	}
}

// animation loop
function animate()
{
	requestAnimationFrame(animate);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	
	for(let i = 0; i < particlesArray.length; i++)
	{
		particlesArray[i].update();
	}
	pull();
}

window.addEventListener('resize',
	function()
	{
		canvas.width = document.getElementById("app_canvas").offsetWidth;
		canvas.height = document.getElementById("app_canvas").offsetHeight;
	
		init();
	}
);


/***************************************************************************
 ***************************************************************************
 *** Form Functions ********************************************************
 ***************************************************************************
 **************************************************************************/

init();
animate();

function toggleGravity()
{
	let toggle = document.getElementById("toggle_gravity");
	if(toggle.value === "Toggle Attraction")
	{
		// toggle.setAttribute("gravity", "off");
		toggle.value = "Toggle Repulsion";
	}else
	{
		// toggle.setAttribute("gravity", "on");
		toggle.value = "Toggle Attraction";
	}
	G *= -1;
}
function planetDecrement()
{
	if(particlesArray.length > 2)
	{
		particlesArray.pop();
	}
	document.getElementById("planet_count").innerHTML = particlesArray.length;
}
function planetIncrement()
{
	let radius = Math.random()*50 + 10;
	let newX = Math.random()*(canvas.width-radius*2)+radius;
	let newY = Math.random()*(canvas.height-radius*2)+radius;
	let mass = radius*radius*radius;
	let rVal = Math.floor(Math.random()*128 + 92);
	let gVal = Math.floor(Math.random()*128 + 92);
	let bVal = Math.floor(Math.random()*128 + 92);
	let oVal = Math.floor(Math.random()*80+20) * 0.01;
	let color = 'rgba(' + rVal + ', ' + gVal + ', ' + bVal + ', ' + oVal + ')';
	particlesArray.push(new Planet('Planet', new Vector(newX, newY), new Vector(0, 0), mass, radius, color));
	
	document.getElementById("planet_count").innerHTML = particlesArray.length;
}
function adjustDecay()
{
	let decaySlider = document.getElementById("slider_decay");
	decay = (decaySlider.value*1.0)/100;
	document.getElementById("decay_value").innerHTML = decay;
}
function adjustG()
{
	let gSlider = document.getElementById("slider_g");
	G = (gSlider.value*1.0) / 1e8;
	document.getElementById("g_value").innerHTML = G;
}