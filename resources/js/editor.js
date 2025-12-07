import domReady from '@wordpress/dom-ready';

// import './blocks/share-buttons';


domReady(() => {
  // (function() {
  //   const initialWidth = document.documentElement.clientWidth;
  //   const initialFontSize = initialWidth >= 1024 ? (initialWidth / 10) : 32;
    
  //   // Apply font size only to WordPress editor elements
  //   const visualEditors = document.querySelectorAll('.editor-styles-wrapper.block-editor-writing-flow');
  //   visualEditors.forEach(element => {
  //     element.style.fontSize = `${initialFontSize}px`;
  //   });
    

  // })();
  
  // function updateRootFontSize() {
  //   const viewportWidth = document.documentElement.clientWidth;
    
  //   let fontSize;
  //   let layoutClass;
    
  //   if (viewportWidth >= 1024) {
  //     // Desktop layout
  //     fontSize = viewportWidth / 10; // 10% of viewport width
  //     layoutClass = 'desktop-layout';
  //   } else {
  //     // Mobile layout
  //     fontSize = 32; // Fixed at 32px for mobile
  //     layoutClass = 'mobile-layout';
  //   }
    
  //   // Only add layout classes to body, no font size changes
  //   document.body.classList.remove('desktop-layout', 'mobile-layout');
  //   document.body.classList.add(layoutClass);
    
  //   // Update only the editor elements on resize
  //   const visualEditors = document.querySelectorAll('.editor-styles-wrapper.block-editor-writing-flow');
  //   visualEditors.forEach(element => {
  //     element.style.fontSize = `${fontSize}px`;
  //   });
    

  // }
  
  // let resizeTimer;
  // window.addEventListener('resize', function() {
  //   clearTimeout(resizeTimer);
  //   resizeTimer = setTimeout(updateRootFontSize, 20);
  // });
  
  // window.addEventListener('DOMContentLoaded', updateRootFontSize);
});

