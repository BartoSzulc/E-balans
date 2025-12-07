// Create a new file: components/NumberCounter.js

import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// Register ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

export default class NumberCounter {
  constructor() {
    this.initialized = false;
  }

  init() {
    if (this.initialized) return;
    this.initialized = true;

    // Find all counter elements
    this.counterElements = document.querySelectorAll('.number-counter span');
    if (!this.counterElements.length) return;

    // Create ScrollTrigger for the Google Ads section
    this.createScrollTrigger();
  }

  createScrollTrigger() {
    ScrollTrigger.create({
      trigger: '.counting',
      start: 'top 80%',
      onEnter: () => {
        this.counterElements.forEach(counter => {
          this.animateCounter(counter);
        });
      },
      once: true
    });
  }

  animateCounter(counterElement) {
    // Get the full text
    const fullText = counterElement.textContent.trim();
    
    // Parse the counter text
    const { prefix, number, suffix } = this.parseCounterText(fullText);
    
    // Calculate the starting value (85% of the target)
    const startPercent = 0.80;
    const startValue = Math.floor(number * startPercent);
    
    // Set the initial value
    counterElement.innerHTML = `${prefix}${startValue}${suffix}`;
    
    // Animate the number
    gsap.to({
      val: startValue
    }, {
      val: number,
      duration: 2,
      ease: "power1.out",
      onUpdate: function() {
        const currentValue = Math.round(this.targets()[0].val);
        counterElement.innerHTML = `${prefix}${currentValue}${suffix}`;
      }
    });
  }

  parseCounterText(text) {
    // Regular expression to find the numeric part
    const regex = /([^\d]*)(\d+[\d\s,.]*)([^\d]*)/;
    const match = text.match(regex);
    
    if (match) {
      // Clean and parse the number (remove spaces, replace commas with dots if necessary)
      const numericText = match[2].replace(/\s/g, '').replace(/,/g, '.');
      const number = parseFloat(numericText);
      
      return {
        prefix: match[1] || '',
        number: number,
        suffix: match[3] || ''
      };
    }
    
    // Fallback if regex doesn't match
    return {
      prefix: '',
      number: parseInt(text, 10) || 0,
      suffix: ''
    };
  }
}