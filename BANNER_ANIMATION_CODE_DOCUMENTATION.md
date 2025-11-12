# MOIST Faculty Evaluation System - Banner Animation Code Documentation

## Complete Code Reference for Debugging Practice

### HTML Structure
```html
<!-- Animated Banner Background -->
<div class="animated-banner">
    <div class="developer-name">lanstheai</div>
    <div class="developer-name">carl'sTheai</div>
    <div class="developer-name">Dongtheai</div>
</div>
```

**📍 WHERE TO FIND THIS CODE:**
- **File Location**: `c:\xampp\htdocs\eval\login.php`
- **Line Numbers**: Around lines 130-135 (inside the `<body>` section)
- **Search for**: `<div class="animated-banner">` or `developer-name`

**🔧 HOW TO MODIFY THE TEXT:**
1. Open `login.php` file
2. Find the `<div class="animated-banner">` section
3. Change the text inside `<div class="developer-name">` tags:
   ```html
   <div class="developer-name">YourNewText1</div>
   <div class="developer-name">YourNewText2</div>
   <div class="developer-name">YourNewText3</div>
   ```

**📝 DEBUGGING TIPS:**
- If text not showing: Check CSS `opacity` and `z-index` values
- If animation not working: Verify `@keyframes` are defined
- If text cut off: Adjust `translateX` radius value
- If colors not visible: Check `color` and `border-color` properties

**🔍 QUICK SEARCH GUIDE:**
- **Find HTML**: Search for `<div class="animated-banner">` in `login.php`
- **Find CSS**: Search for `.developer-name` or `@keyframes orbitAndDisappear`
- **Find Animation**: Look for `animation:` property in CSS
- **Find Colors**: Search for `color:` and `border-color:` properties

**📂 FILE STRUCTURE FOR BANNER:**
```
c:\xampp\htdocs\eval\
├── login.php (Contains HTML + CSS for banner)
├── BANNER_ANIMATION_CODE_DOCUMENTATION.md (This file)
└── assets\img\ (Background images)
```

**⚡ COMMON ISSUES & SOLUTIONS:**
1. **Text not orbiting**: Missing `@keyframes orbitAndDisappear` definition
2. **All text same color**: Check individual `:nth-child()` CSS rules
3. **Animation too fast/slow**: Modify `30s` duration value
4. **Text too small/big**: Adjust `font-size: 1.8rem` value
5. **Orbit too wide/narrow**: Change `translateX(350px)` radius

### CSS Classes and Animations

#### 1. Main Banner Container
```css
.animated-banner {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  z-index: 1;
  overflow: hidden;
  pointer-events: none;
}
```
**Purpose**: Creates full-screen background container for animations
**Key Properties**: 
- `position: fixed` - Stays in place during scroll
- `z-index: 1` - Behind login form (z-index: 10)
- `pointer-events: none` - Doesn't interfere with form interaction

#### 2. Developer Names (Orbiting Animation)
```css
.developer-name {
  position: absolute;
  font-size: 1.8rem;
  font-weight: 900;
  text-shadow: 3px 3px 6px rgba(0,0,0,0.8), 0 0 10px rgba(255,255,255,0.5);
  background: rgba(0,0,0,0.7);
  padding: 8px 16px;
  border-radius: 25px;
  border: 2px solid rgba(255,255,255,0.3);
  animation: orbitAndDisappear 30s infinite ease-in-out;
  z-index: 5;
  pointer-events: none;
  left: 50%;
  top: 50%;p
  backdrop-filter: blur(5px);
}
```
**Purpose**: Styles for developer name badges that orbit around login form
**Key Features**:
- Large font (1.8rem) with ultra-bold weight (900)
- Dark semi-transparent background for visibility
- Pill-shaped design with rounded corners
- Double text shadow for depth effect
- Backdrop blur for modern glass effect

#### 3. Individual Developer Colors
```css
.developer-name:nth-child(1) {
  animation-delay: 0s;
  color: #FF4500;
  border-color: #FF4500;
}

.developer-name:nth-child(2) {
  animation-delay: 10s;
  color: #1E90FF;
  border-color: #1E90FF;
}

.developer-name:nth-child(3) {
  animation-delay: 20s;
  color: #32CD32;
  border-color: #32CD32;
}
```
**Purpose**: Assigns unique colors and timing to each developer
**Color Scheme**:
- lanstheai: Orange (#FF4500) - starts immediately
- carl'sTheai: Blue (#1E90FF) - starts after 10s
- Dongtheai: Green (#32CD32) - starts after 20s

#### 4. Floating Text (MOIST & Faculty Evaluation)
```css
.floating-text {
  position: absolute;
  font-size: 1.5rem;
  font-weight: bold;
  color: rgba(128, 0, 0, 0.3);
  animation: float 6s ease-in-out infinite;
  pointer-events: none;
}

.floating-text:nth-child(2) {
  top: 20%;
  left: 50%;
  transform: translateX(-50%);
  animation-delay: 1s;
}

.floating-text:nth-child(3) {
  bottom: 20%;
  left: 50%;
  transform: translateX(-50%);
  animation-delay: 3s;
}
```
**Purpose**: Creates floating system title text
**Positioning**: Center-aligned at top (20%) and bottom (20%) of screen

### Animation Keyframes

#### 1. Orbit Animation (Main Feature)
```css
@keyframes orbitAndDisappear {
  0%, 10% {
    transform: translate(-50%, -50%) rotate(0deg) translateX(350px) rotate(0deg);
    opacity: 1;
  }
  20% {
    transform: translate(-50%, -50%) rotate(90deg) translateX(350px) rotate(-90deg);
    opacity: 1;
  }
  30% {
    transform: translate(-50%, -50%) rotate(180deg) translateX(350px) rotate(-180deg);
    opacity: 1;
  }
  40% {
    transform: translate(-50%, -50%) rotate(270deg) translateX(350px) rotate(-270deg);
    opacity: 1;
  }
  50% {
    transform: translate(-50%, -50%) rotate(360deg) translateX(350px) rotate(-360deg);
    opacity: 1;
  }
  60%, 100% {
    transform: translate(-50%, -50%) rotate(360deg) translateX(350px) rotate(-360deg);
    opacity: 0;
  }
}
```
**How it works**:
- **0-50%**: Complete 360° orbit around center point (visible)
- **60-100%**: Hidden phase (opacity: 0)
- **Radius**: 350px from center
- **Duration**: 30 seconds total cycle
- **Transform Logic**: 
  - `translate(-50%, -50%)` - Centers element
  - `rotate(Xdeg)` - Rotates orbit position
  - `translateX(350px)` - Moves out to orbit radius
  - `rotate(-Xdeg)` - Counter-rotates text to keep upright

#### 2. Floating Text Animation
```css
@keyframes float {
  0%, 100% {
    transform: translateX(-50%) translateY(0);
    opacity: 0.3;
  }
  50% {
    transform: translateX(-50%) translateY(-20px);
    opacity: 0.6;
  }
}
```
**How it works**:
- Simple up/down floating motion
- Opacity changes for breathing effect
- 6-second cycle duration

### Mobile Responsiveness
```css
@media (max-width: 768px) {
  .running-character {
    width: 80px;
    height: 80px;
  }
  
  .floating-text {
    font-size: 1rem;
  }
}
```

### Z-Index Hierarchy
- **animated-banner**: z-index: 1 (background)
- **developer-name**: z-index: 5 (above banner, below form)
- **login-box**: z-index: 10 (foreground)

### Common Debugging Issues

1. **Names not visible**: Check z-index values and opacity settings
2. **Animation not smooth**: Verify transform syntax and timing functions
3. **Names cut off**: Adjust orbit radius (translateX value) or container overflow
4. **Colors not showing**: Check color values and contrast against background
5. **Performance issues**: Consider reducing animation complexity or duration

### Animation Timeline (30-second cycle)
- **0-15s**: Developer name orbits and is visible
- **15-30s**: Developer name is hidden
- **Staggered start**: Each name starts 10 seconds apart

### Key Variables to Modify
- **Orbit radius**: Change `translateX(350px)` value
- **Animation speed**: Modify `30s` duration
- **Colors**: Update color hex values
- **Font size**: Adjust `1.8rem` value
- **Visibility duration**: Modify keyframe percentages

## Alternative Orbit Directions

### Reverse/Opposite Orbit Animation
```css
@keyframes orbitAndDisappearReverse {
  0%, 10% {
    transform: translate(-50%, -50%) rotate(0deg) translateX(350px) rotate(0deg);
    opacity: 1;
  }
  20% {
    transform: translate(-50%, -50%) rotate(-90deg) translateX(350px) rotate(90deg);
    opacity: 1;
  }
  30% {
    transform: translate(-50%, -50%) rotate(-180deg) translateX(350px) rotate(180deg);
    opacity: 1;
  }
  40% {
    transform: translate(-50%, -50%) rotate(-270deg) translateX(350px) rotate(270deg);
    opacity: 1;
  }
  50% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(350px) rotate(360deg);
    opacity: 1;
  }
  60%, 100% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(350px) rotate(360deg);
    opacity: 0;
  }
}
```

**How to use**: Replace `orbitAndDisappear` with `orbitAndDisappearReverse` in your CSS
```css
.developer-name {
  animation: orbitAndDisappearReverse 30s infinite ease-in-out;
}
```

**Difference from original**:
- **Original**: Clockwise rotation (0° → 90° → 180° → 270° → 360°)
- **Reverse**: Counter-clockwise rotation (0° → -90° → -180° → -270° → -360°)
- **Text orientation**: Counter-rotated to keep text upright in both directions

### Mixed Direction Animation (Alternating)
```css
.developer-name:nth-child(odd) {
  animation: orbitAndDisappear 30s infinite ease-in-out;
}

.developer-name:nth-child(even) {
  animation: orbitAndDisappearReverse 30s infinite ease-in-out;
}
```

**Purpose**: Creates alternating orbit directions
- **Odd elements** (1st, 3rd): Clockwise orbit
- **Even elements** (2nd, 4th): Counter-clockwise orbit

### Faster Reverse Orbit
```css
@keyframes orbitAndDisappearReverseFast {
  0%, 10% {
    transform: translate(-50%, -50%) rotate(0deg) translateX(350px) rotate(0deg);
    opacity: 1;
  }
  30% {
    transform: translate(-50%, -50%) rotate(-180deg) translateX(350px) rotate(180deg);
    opacity: 1;
  }
  50% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(350px) rotate(360deg);
    opacity: 1;
  }
  60%, 100% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(350px) rotate(360deg);
    opacity: 0;
  }
}
```

**Usage**:
```css
.developer-name {
  animation: orbitAndDisappearReverseFast 20s infinite ease-in-out;
}
```

**Features**:
- **Faster orbit**: 20 seconds instead of 30
- **Counter-clockwise direction**
- **Fewer keyframes**: Smoother animation

## Left-Side Orbit Animations

### Left-Side Clockwise Orbit
```css
@keyframes orbitLeftSide {
  0%, 10% {
    transform: translate(-50%, -50%) rotate(0deg) translateX(-350px) rotate(0deg);
    opacity: 1;
  }
  20% {
    transform: translate(-50%, -50%) rotate(90deg) translateX(-350px) rotate(-90deg);
    opacity: 1;
  }
  30% {
    transform: translate(-50%, -50%) rotate(180deg) translateX(-350px) rotate(-180deg);
    opacity: 1;
  }
  40% {
    transform: translate(-50%, -50%) rotate(270deg) translateX(-350px) rotate(-270deg);
    opacity: 1;
  }
  50% {
    transform: translate(-50%, -50%) rotate(360deg) translateX(-350px) rotate(-360deg);
    opacity: 1;
  }
  60%, 100% {
    transform: translate(-50%, -50%) rotate(360deg) translateX(-350px) rotate(-360deg);
    opacity: 0;
  }
}
```

**Usage**:
```css
.developer-name {
  animation: orbitLeftSide 30s infinite ease-in-out;
}
```

**Key difference**: `translateX(-350px)` instead of `translateX(350px)`
- **Negative value** = Left side orbit
- **Positive value** = Right side orbit

### Left-Side Counter-Clockwise Orbit
```css
@keyframes orbitLeftSideReverse {
  0%, 10% {
    transform: translate(-50%, -50%) rotate(0deg) translateX(-350px) rotate(0deg);
    opacity: 1;
  }
  20% {
    transform: translate(-50%, -50%) rotate(-90deg) translateX(-350px) rotate(90deg);
    opacity: 1;
  }
  30% {
    transform: translate(-50%, -50%) rotate(-180deg) translateX(-350px) rotate(180deg);
    opacity: 1;
  }
  40% {
    transform: translate(-50%, -50%) rotate(-270deg) translateX(-350px) rotate(270deg);
    opacity: 1;
  }
  50% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(-350px) rotate(360deg);
    opacity: 1;
  }
  60%, 100% {
    transform: translate(-50%, -50%) rotate(-360deg) translateX(-350px) rotate(360deg);
    opacity: 0;
  }
}
```

**Usage**:
```css
.developer-name {
  animation: orbitLeftSideReverse 30s infinite ease-in-out;
}
```

### Mixed Left and Right Side Orbits
```css
.developer-name:nth-child(1) {
  animation: orbitLeftSide 30s infinite ease-in-out;
  animation-delay: 0s;
}

.developer-name:nth-child(2) {
  animation: orbitAndDisappear 30s infinite ease-in-out;
  animation-delay: 10s;
}

.developer-name:nth-child(3) {
  animation: orbitLeftSideReverse 30s infinite ease-in-out;
  animation-delay: 20s;
}
```

**Result**:
- **1st name**: Left-side clockwise orbit
- **2nd name**: Right-side clockwise orbit  
- **3rd name**: Left-side counter-clockwise orbit

### Orbit Direction Reference
| Animation Name | Side | Direction | translateX Value |
|---|---|---|---|
| `orbitAndDisappear` | Right | Clockwise | `350px` |
| `orbitAndDisappearReverse` | Right | Counter-clockwise | `350px` |
| `orbitLeftSide` | Left | Clockwise | `-350px` |
| `orbitLeftSideReverse` | Left | Counter-clockwise | `-350px` |

## How to Stop/Disable Banner Animation

### Method 1: Remove Animation Property
```css
.developer-name {
  position: absolute;
  font-size: 1.8rem;
  font-weight: 900;
  text-shadow: 3px 3px 6px rgba(0,0,0,0.8), 0 0 10px rgba(255,255,255,0.5);
  background: rgba(0,0,0,0.7);
  padding: 8px 16px;
  border-radius: 25px;
  border: 2px solid rgba(255,255,255,0.3);
  /* animation: orbitAndDisappear 30s infinite ease-in-out; -- REMOVE THIS LINE */
  z-index: 5;
  pointer-events: none;
  left: 50%;
  top: 50%;
  backdrop-filter: blur(5px);
}
```

### Method 2: Set Animation to None
```css
.developer-name {
  animation: none; /* Disables all animations */
  /* other properties stay the same */
}
```

### Method 3: Pause Animation (Keeps position)
```css
.developer-name {
  animation-play-state: paused; /* Pauses animation at current position */
}
```

### Method 4: Hide Banner Completely
```css
.animated-banner {
  display: none; /* Completely hides the banner */
}
```

**OR** in HTML, change class name to disable:
```html
<!-- Change this -->
<div class="animated-banner">

<!-- To this (adds typo to disable CSS) -->
<div class="animated-banner-disabled">
```

### Method 5: Static Positioning (No orbit, fixed position)
```css
.developer-name {
  position: static; /* Removes absolute positioning */
  animation: none;   /* Removes animation */
  display: inline-block; /* Makes them appear in line */
  margin: 10px;      /* Adds spacing between names */
}
```

### Quick Disable Options:

**🚫 Complete Disable:**
- Comment out `<div class="animated-banner">` section in HTML
- Or add `display: none;` to `.animated-banner`

**⏸️ Pause Animation:**
- Add `animation-play-state: paused;` to `.developer-name`

**🔧 Remove Orbit Only:**
- Remove `animation:` property from `.developer-name`
- Keep styling but no movement
