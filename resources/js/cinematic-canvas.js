/**
 * CINEMATIC 3D ENGINE v2 — Extraordinary Edition
 * Custom shaders, post-processing bloom, mouse parallax,
 * camera dolly, orbital rings, Lenis smooth scroll
 */
import * as THREE from 'three';
import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from '@studio-freight/lenis';

gsap.registerPlugin(ScrollTrigger);

// ── Module state ──
let renderer, scene, camera, clock, composer, animFrameId, lenis;
let mousePivot, heroGroup, coreOrb, orbitalRings = [], dustField, nebulaField;
let mouse = { x: 0, y: 0, tx: 0, ty: 0 };
let scrollProgress = 0;

// ── Vertex displacement shader (organic morphing) ──
const morphVertexShader = `
  uniform float uTime;
  uniform float uMorph;
  varying vec3 vNormal;
  varying vec3 vPosition;
  varying float vDisplacement;

  // Simplex-style noise via sine stacking
  float snoise(vec3 p) {
    return sin(p.x * 1.7 + p.y * 2.3) * cos(p.z * 1.9 + p.x * 0.7)
         + sin(p.y * 3.1 + p.z * 1.3) * 0.5
         + cos(p.x * 2.7 + p.z * 3.7 + uTime * 0.3) * 0.3;
  }

  void main() {
    vNormal = normalize(normalMatrix * normal);
    vec3 pos = position;

    float noise = snoise(pos * 0.8 + uTime * 0.15) * uMorph;
    float pulse = sin(uTime * 0.5) * 0.08;
    float displacement = noise * (0.3 + pulse);

    pos += normal * displacement;
    vDisplacement = displacement;
    vPosition = pos;

    gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);
  }
`;

const morphFragmentShader = `
  uniform float uTime;
  uniform vec3 uColor1;
  uniform vec3 uColor2;
  uniform vec3 uColor3;
  varying vec3 vNormal;
  varying vec3 vPosition;
  varying float vDisplacement;

  void main() {
    // Fresnel rim glow
    vec3 viewDir = normalize(cameraPosition - vPosition);
    float fresnel = pow(1.0 - abs(dot(viewDir, vNormal)), 3.0);

    // Color blend based on displacement + time
    float t = vDisplacement * 2.0 + uTime * 0.1;
    vec3 color = mix(uColor1, uColor2, sin(t) * 0.5 + 0.5);
    color = mix(color, uColor3, fresnel * 0.7);

    // Emissive glow
    float glow = fresnel * 0.8 + 0.15;
    gl_FragColor = vec4(color * glow, 0.85 + fresnel * 0.15);
  }
`;

// ── Bootstrap ──
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('cinematic-canvas');
    if (!canvas) return;
    init(canvas);
    initLenis();
    animate();
    setupScrollAnimations();
    setupMouseParallax();
});

function init(canvas) {
    // Renderer
    renderer = new THREE.WebGLRenderer({
        canvas, antialias: true, alpha: true,
        powerPreference: 'high-performance',
    });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.0;

    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, 0.1, 200);
    camera.position.set(0, 0, 6);

    clock = new THREE.Clock();

    // Post-processing bloom
    composer = new EffectComposer(renderer);
    composer.addPass(new RenderPass(scene, camera));
    const bloom = new UnrealBloomPass(
        new THREE.Vector2(window.innerWidth, window.innerHeight),
        1.2, 0.5, 0.3  // strength, radius, threshold
    );
    composer.addPass(bloom);

    // Lighting
    scene.add(new THREE.AmbientLight(0x1a1a2e, 0.6));

    const keyLight = new THREE.DirectionalLight(0x4F46E5, 1.5);
    keyLight.position.set(3, 5, 4);
    scene.add(keyLight);

    const fillLight = new THREE.PointLight(0x06B6D4, 1.2, 30);
    fillLight.position.set(-5, -2, 3);
    scene.add(fillLight);

    const rimLight = new THREE.PointLight(0xec4899, 0.9, 25);
    rimLight.position.set(4, -4, -2);
    scene.add(rimLight);

    const topLight = new THREE.PointLight(0x8b5cf6, 0.6, 20);
    topLight.position.set(0, 6, 0);
    scene.add(topLight);

    // Build scene objects
    // mousePivot handles mouse parallax — completely separate from GSAP scroll
    mousePivot = new THREE.Group();
    scene.add(mousePivot);

    heroGroup = new THREE.Group();
    mousePivot.add(heroGroup);

    createCoreOrb();
    createOrbitalRings();
    createDustField();
    createNebulaField();

    window.addEventListener('resize', handleResize);
}

// ═══════════════════════════════════════════
// CORE ORB — Custom shader morphing sphere
// ═══════════════════════════════════════════
function createCoreOrb() {
    const geo = new THREE.IcosahedronGeometry(1.5, 64);
    const mat = new THREE.ShaderMaterial({
        vertexShader: morphVertexShader,
        fragmentShader: morphFragmentShader,
        uniforms: {
            uTime: { value: 0 },
            uMorph: { value: 1.0 },
            uColor1: { value: new THREE.Color(0x4F46E5) },
            uColor2: { value: new THREE.Color(0x06B6D4) },
            uColor3: { value: new THREE.Color(0xec4899) },
        },
        transparent: true,
        side: THREE.DoubleSide,
    });
    coreOrb = new THREE.Mesh(geo, mat);
    heroGroup.add(coreOrb);

    // Wireframe overlay
    const wireGeo = new THREE.IcosahedronGeometry(1.62, 2);
    const wireMat = new THREE.MeshBasicMaterial({
        color: 0x4F46E5, wireframe: true,
        transparent: true, opacity: 0.08,
    });
    const wire = new THREE.Mesh(wireGeo, wireMat);
    coreOrb.add(wire);
}

// ═══════════════════════════════════════════
// ORBITAL RINGS — Glowing torus rings
// ═══════════════════════════════════════════
function createOrbitalRings() {
    const configs = [
        { radius: 2.4, tube: 0.008, color: 0x4F46E5, tiltX: 1.2, tiltY: 0.3, speed: 0.3 },
        { radius: 2.8, tube: 0.006, color: 0x06B6D4, tiltX: 0.5, tiltY: 1.0, speed: -0.2 },
        { radius: 3.2, tube: 0.005, color: 0xec4899, tiltX: 0.8, tiltY: 0.6, speed: 0.15 },
        { radius: 2.0, tube: 0.01,  color: 0x8b5cf6, tiltX: 1.5, tiltY: 0.1, speed: -0.4 },
    ];

    configs.forEach((c) => {
        const geo = new THREE.TorusGeometry(c.radius, c.tube, 16, 128);
        const mat = new THREE.MeshBasicMaterial({
            color: c.color, transparent: true, opacity: 0.4,
        });
        const ring = new THREE.Mesh(geo, mat);
        ring.rotation.x = c.tiltX;
        ring.rotation.y = c.tiltY;
        ring.userData = { speed: c.speed, baseOpacity: 0.4 };
        heroGroup.add(ring);
        orbitalRings.push(ring);
    });
}

// ═══════════════════════════════════════════
// DUST FIELD — Reactive floating particles
// ═══════════════════════════════════════════
function createDustField() {
    const count = 3000;
    const pos = new Float32Array(count * 3);
    const col = new Float32Array(count * 3);
    const sizes = new Float32Array(count);
    const velocities = new Float32Array(count * 3);

    const palette = [
        new THREE.Color(0x4F46E5), new THREE.Color(0x06B6D4),
        new THREE.Color(0xec4899), new THREE.Color(0x8b5cf6),
        new THREE.Color(0xffffff),
    ];

    for (let i = 0; i < count; i++) {
        const i3 = i * 3;
        const r = 3 + Math.random() * 18;
        const theta = Math.random() * Math.PI * 2;
        const phi = Math.acos(2 * Math.random() - 1);
        pos[i3]     = r * Math.sin(phi) * Math.cos(theta);
        pos[i3 + 1] = r * Math.sin(phi) * Math.sin(theta);
        pos[i3 + 2] = r * Math.cos(phi);
        velocities[i3]     = (Math.random() - 0.5) * 0.002;
        velocities[i3 + 1] = (Math.random() - 0.5) * 0.002;
        velocities[i3 + 2] = (Math.random() - 0.5) * 0.002;
        const c = palette[Math.floor(Math.random() * palette.length)];
        col[i3] = c.r; col[i3+1] = c.g; col[i3+2] = c.b;
        sizes[i] = Math.random() * 2.5 + 0.5;
    }

    const geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    geo.setAttribute('color', new THREE.BufferAttribute(col, 3));
    geo.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
    geo.userData = { velocities };

    const mat = new THREE.PointsMaterial({
        size: 0.04, vertexColors: true, transparent: true,
        opacity: 0.65, blending: THREE.AdditiveBlending,
        depthWrite: false, sizeAttenuation: true,
    });
    dustField = new THREE.Points(geo, mat);
    scene.add(dustField);
}

// ═══════════════════════════════════════════
// NEBULA — Dense inner particle cloud
// ═══════════════════════════════════════════
function createNebulaField() {
    const count = 800;
    const pos = new Float32Array(count * 3);
    const col = new Float32Array(count * 3);

    for (let i = 0; i < count; i++) {
        const i3 = i * 3;
        // Concentrated near the core
        const r = Math.random() * 4;
        const theta = Math.random() * Math.PI * 2;
        const phi = Math.acos(2 * Math.random() - 1);
        pos[i3]     = r * Math.sin(phi) * Math.cos(theta);
        pos[i3 + 1] = r * Math.sin(phi) * Math.sin(theta) * 0.4; // flatten
        pos[i3 + 2] = r * Math.cos(phi);
        const t = Math.random();
        const c = new THREE.Color().lerpColors(
            new THREE.Color(0x4F46E5), new THREE.Color(0x06B6D4), t
        );
        col[i3] = c.r; col[i3+1] = c.g; col[i3+2] = c.b;
    }

    const geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    geo.setAttribute('color', new THREE.BufferAttribute(col, 3));

    const mat = new THREE.PointsMaterial({
        size: 0.08, vertexColors: true, transparent: true,
        opacity: 0.35, blending: THREE.AdditiveBlending,
        depthWrite: false, sizeAttenuation: true,
    });
    nebulaField = new THREE.Points(geo, mat);
    heroGroup.add(nebulaField);
}

// ═══════════════════════════════════════════
// LENIS SMOOTH SCROLL
// ═══════════════════════════════════════════
function initLenis() {
    lenis = new Lenis({
        duration: 1.8,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
        touchMultiplier: 1.5,
    });

    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
}

// ═══════════════════════════════════════════
// MOUSE PARALLAX
// ═══════════════════════════════════════════
function setupMouseParallax() {
    window.addEventListener('mousemove', (e) => {
        mouse.tx = (e.clientX / window.innerWidth - 0.5) * 2;
        mouse.ty = (e.clientY / window.innerHeight - 0.5) * 2;
    }, { passive: true });
}

// ═══════════════════════════════════════════
// SCROLL ANIMATIONS — Single master timeline
// One timeline, one scrub, zero overlap = zero jumps
// ═══════════════════════════════════════════
function setupScrollAnimations() {
    // ── MASTER TIMELINE on the full page scroll ──
    const master = gsap.timeline({
        scrollTrigger: {
            trigger: '.cinematic-overlay',
            start: 'top top',
            end: 'bottom bottom',
            scrub: 2.5,           // single consistent scrub for everything
            onUpdate: (self) => { scrollProgress = self.progress; },
        },
    });

    // Keyframe positions (0 = top of page, 1 = bottom)
    // These divide the page into smooth, non-overlapping segments
    const K = {
        heroStart:     0,
        heroEnd:       0.22,
        featStart:     0.22,
        featEnd:       0.48,
        showStart:     0.48,
        showEnd:       0.72,
        ctaStart:      0.72,
        ctaEnd:        0.92,
    };

    // ── HERO → FEATURES transition ──
    // Camera pulls back, orb shrinks & rotates
    master.fromTo(camera.position,
        { z: 6, y: 0 },
        { z: 8, y: -0.3, ease: 'power1.inOut' },
        K.heroStart
    );
    master.fromTo(heroGroup.rotation,
        { x: 0, y: 0, z: 0 },
        { x: 0.2, y: Math.PI * 0.5, z: 0, ease: 'power1.inOut' },
        K.heroStart
    );
    master.fromTo(heroGroup.scale,
        { x: 1, y: 1, z: 1 },
        { x: 0.7, y: 0.7, z: 0.7, ease: 'power1.inOut' },
        K.heroStart
    );
    // (heroGroup.position stays at 0,0,0 during hero)

    // ── FEATURES section ──
    // Orb drifts right, camera eases forward, tilt on Z
    master.to(heroGroup.position,
        { x: 2.5, y: -0.6, ease: 'power1.inOut' },
        K.featStart
    );
    master.to(heroGroup.rotation,
        { y: Math.PI * 1.1, z: 0.25, ease: 'power1.inOut' },
        K.featStart
    );
    master.to(camera.position,
        { z: 7.2, y: -0.1, ease: 'power1.inOut' },
        K.featStart
    );

    // ── SHOWCASE section ──
    // Sweep left, enlarge, straighten tilt
    master.to(heroGroup.position,
        { x: -1.8, y: 0, ease: 'power1.inOut' },
        K.showStart
    );
    master.to(heroGroup.scale,
        { x: 1.1, y: 1.1, z: 1.1, ease: 'power1.inOut' },
        K.showStart
    );
    master.to(heroGroup.rotation,
        { y: Math.PI * 1.8, z: 0, x: 0.1, ease: 'power1.inOut' },
        K.showStart
    );
    master.to(camera.position,
        { z: 6.5, y: 0, ease: 'power1.inOut' },
        K.showStart
    );

    // ── CTA section ──
    // Re-center with epic scale, camera pushes in
    master.to(heroGroup.position,
        { x: 0, y: 0, z: 0, ease: 'power1.inOut' },
        K.ctaStart
    );
    master.to(heroGroup.scale,
        { x: 1.4, y: 1.4, z: 1.4, ease: 'power1.inOut' },
        K.ctaStart
    );
    master.to(heroGroup.rotation,
        { y: Math.PI * 2.2, z: 0, x: 0, ease: 'power1.inOut' },
        K.ctaStart
    );
    master.to(camera.position,
        { z: 5, y: 0, ease: 'power1.inOut' },
        K.ctaStart
    );

    // ── UI element reveals (these stay separate — they're one-shot, no conflict) ──
    gsap.utils.toArray('.reveal-on-scroll').forEach((el) => {
        gsap.from(el, {
            y: 60, opacity: 0, duration: 1.4,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el, start: 'top 88%',
                toggleActions: 'play none none reverse',
            },
        });
    });

    gsap.utils.toArray('.cin-feature-grid .cin-glass-panel').forEach((el, i) => {
        gsap.from(el, {
            y: 80, opacity: 0, scale: 0.95,
            duration: 1.2, delay: i * 0.12,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el, start: 'top 90%',
                toggleActions: 'play none none reverse',
            },
        });
    });
}

// ═══════════════════════════════════════════
// RENDER LOOP — The heart of the engine
// ═══════════════════════════════════════════
function animate() {
    animFrameId = requestAnimationFrame(animate);
    const elapsed = clock.getElapsedTime();
    const delta = clock.getDelta();

    // Smooth mouse interpolation
    mouse.x += (mouse.tx - mouse.x) * 0.035;
    mouse.y += (mouse.ty - mouse.y) * 0.035;

    // Mouse parallax on the PIVOT — completely decoupled from GSAP scroll
    if (mousePivot) {
        mousePivot.rotation.y = mouse.x * 0.12;
        mousePivot.rotation.x = mouse.y * 0.08;
    }

    // Update core orb shader
    if (coreOrb?.material.uniforms) {
        coreOrb.material.uniforms.uTime.value = elapsed;
        // Morph intensity increases with scroll
        coreOrb.material.uniforms.uMorph.value = 0.8 + scrollProgress * 1.5;

        // Dynamic color shift on scroll
        const p = scrollProgress;
        coreOrb.material.uniforms.uColor1.value.setHSL(
            0.68 - p * 0.15, 0.8, 0.55
        );
        coreOrb.material.uniforms.uColor2.value.setHSL(
            0.52 + p * 0.1, 0.85, 0.5
        );
    }

    // Slow idle rotation on core
    if (coreOrb) {
        coreOrb.rotation.y += 0.003;
        coreOrb.rotation.x = Math.sin(elapsed * 0.2) * 0.1;
    }

    // Orbital rings
    orbitalRings.forEach((ring, i) => {
        const spd = ring.userData.speed;
        ring.rotation.z += spd * 0.008;
        ring.rotation.x += spd * 0.003;
        // Pulsing opacity
        ring.material.opacity = ring.userData.baseOpacity +
            Math.sin(elapsed * (0.5 + i * 0.2)) * 0.15;
    });

    // Dust field drift
    if (dustField) {
        dustField.rotation.y = elapsed * 0.015;
        dustField.rotation.x = Math.sin(elapsed * 0.01) * 0.05;

        // Animate individual particles
        const positions = dustField.geometry.attributes.position.array;
        const velocities = dustField.geometry.userData.velocities;
        for (let i = 0; i < positions.length; i += 3) {
            positions[i]     += velocities[i];
            positions[i + 1] += velocities[i + 1];
            positions[i + 2] += velocities[i + 2];

            // Gentle boundary wrap
            const dist = Math.sqrt(
                positions[i] ** 2 + positions[i+1] ** 2 + positions[i+2] ** 2
            );
            if (dist > 22) {
                positions[i]     *= 0.3;
                positions[i + 1] *= 0.3;
                positions[i + 2] *= 0.3;
            }
        }
        dustField.geometry.attributes.position.needsUpdate = true;
    }

    // Nebula rotation
    if (nebulaField) {
        nebulaField.rotation.y = elapsed * 0.08;
        nebulaField.rotation.z = Math.sin(elapsed * 0.15) * 0.2;
    }

    // Dynamic tone mapping exposure on scroll
    renderer.toneMappingExposure = 1.0 + scrollProgress * 0.4;

    composer.render();
}

function handleResize() {
    if (!renderer) return;
    const w = window.innerWidth, h = window.innerHeight;
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
    renderer.setSize(w, h);
    composer.setSize(w, h);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
}

// ═══════════════════════════════════════════
// CLEANUP
// ═══════════════════════════════════════════
function destroy() {
    if (animFrameId) { cancelAnimationFrame(animFrameId); animFrameId = null; }
    lenis?.destroy();
    ScrollTrigger.getAll().forEach((st) => st.kill());
    gsap.killTweensOf('*');

    scene?.traverse((child) => {
        if (child.geometry) child.geometry.dispose();
        if (child.material) {
            const mats = Array.isArray(child.material) ? child.material : [child.material];
            mats.forEach((m) => {
                Object.keys(m).forEach((k) => {
                    if (m[k] && typeof m[k].dispose === 'function') m[k].dispose();
                });
                m.dispose();
            });
        }
    });

    composer?.dispose();
    renderer?.dispose();
    window.removeEventListener('resize', handleResize);
    renderer = scene = camera = clock = composer = null;
    mousePivot = heroGroup = coreOrb = dustField = nebulaField = null;
    orbitalRings = [];
}

window.addEventListener('beforeunload', destroy);
window.addEventListener('pagehide', destroy);

/*
 * ──────────────────────────────────────────────────────
 *  LOAD YOUR OWN .GLB / .GLTF MODEL
 *
 *  import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
 *  const loader = new GLTFLoader();
 *  loader.load('/models/my-model.glb', (gltf) => {
 *      const model = gltf.scene;
 *      model.scale.set(2, 2, 2);
 *      heroGroup.add(model);
 *  });
 * ──────────────────────────────────────────────────────
 */
