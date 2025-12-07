/**
 * Custom Select Component
 * Applies Tom-Select to all elements with class "select-custom"
 */
import TomSelect from 'tom-select';

class CustomSelect {
  constructor() {
    // DOM elements - all selects with class "select-custom"
    this.$selectElements = document.querySelectorAll('.select-custom');
    
    // Collection to store all TomSelect instances
    this.tomSelectInstances = [];
    
    // Initialize on page load
    this.init();
    
    // Set up event listeners for dynamic content
    this.setupEventListeners();
  }
  
  init() {
    // Initialize TomSelect for each element
    const uninitializedSelects = document.querySelectorAll('.select-custom:not(.tomselected)');
    uninitializedSelects.forEach(selectElement => {
      this.initializeTomSelect(selectElement);
    });
  }
  
  setupEventListeners() {
    // Listen for the Contact Form 7 Repeatable Fields add event
    document.addEventListener('wpcf7-field-groups/added', this.handleFieldGroupAdded.bind(this));
    
    // As a fallback, also listen for click on add buttons
    document.addEventListener('click', this.handleButtonClick.bind(this));
  }
  
  handleFieldGroupAdded(event) {
    // Wait a small amount of time for the DOM to be fully updated
    setTimeout(() => {
      // Find all uninitialized select elements
      const uninitializedSelects = document.querySelectorAll('.select-custom:not(.tomselected)');
      uninitializedSelects.forEach(selectElement => {
        this.initializeTomSelect(selectElement);
      });
    }, 50);
  }
  
  handleButtonClick(event) {
    // Check if the clicked element is the add button
    if (event.target.closest('.wpcf7-field-group-add')) {
      // Wait for DOM updates
      setTimeout(() => {
        // Find all uninitialized select elements
        const uninitializedSelects = document.querySelectorAll('.select-custom:not(.tomselected)');
        uninitializedSelects.forEach(selectElement => {
          this.initializeTomSelect(selectElement);
        });
      }, 100);
    }
  }
  
  initializeTomSelect(selectElement) {
    if (!selectElement || selectElement.classList.contains('tomselected')) return;
    
    // Create an empty option element to serve as placeholder if not already exists
    let firstOption = selectElement.querySelector('option:first-child');
    let hasPlaceholder = firstOption && firstOption.value === '';
    
    // If no empty first option exists, create one
    if (!hasPlaceholder) {
      const placeholderOption = document.createElement('option');
      placeholderOption.value = '';
      placeholderOption.textContent = 'Temat wiadomości';
      placeholderOption.selected = true;
      
      // Insert the placeholder as the first option
      if (firstOption) {
        selectElement.insertBefore(placeholderOption, firstOption);
      } else {
        selectElement.appendChild(placeholderOption);
      }
      
      firstOption = placeholderOption;
      hasPlaceholder = true;
    }
    
    // Use the placeholder text from the first option
    const placeholderText = firstOption.textContent;
    
    try {
      // Create TomSelect instance
      const tomSelectInstance = new TomSelect(selectElement, {
        plugins: [],
        allowEmptyOption: true,
        closeAfterSelect: true,
        searchEnabled: false,
        create: false,
        controlInput: null,
        placeholder: placeholderText,
        render: {
          option: function(data) {
            return `<div class="option">${data.text}</div>`;
          },
          item: function(data) {
            return `<div class="item option-selected">${data.text}</div>`;
          },
          // Add custom placeholder rendering
          placeholder: function(data) {
            return `<div class="placeholder">${data.text}</div>`;
          }
        },
        // Add callback when an item is selected
        onItemAdd: function(value, item) {
          // Add class to wrapper to indicate an item is selected
          this.wrapper.classList.add('has-selection');
        },
        onItemRemove: function(value) {
          // If there are no more items selected, remove the class
          if (this.items.length === 0) {
            this.wrapper.classList.remove('has-selection');
          }
        },
        // Add callback when dropdown is opened
        onDropdownOpen: function($dropdown) {
          this.wrapper.classList.add('dropdown-open');
        },
        // Add callback when dropdown is closed
        onDropdownClose: function($dropdown) {
          this.wrapper.classList.remove('dropdown-open');
        }
      });
      
      // Add custom dropdown indicator
      const wrapper = tomSelectInstance.wrapper;
      const customIndicator = document.createElement('div');
      customIndicator.className = 'ts-indicator';
      customIndicator.innerHTML = `
       
        <svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.8335 8.41669L10.0002 12.5834L14.1668 8.41669" stroke="#393939" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

      `;
      
      // Find and replace the default caret
      const defaultCaret = wrapper.querySelector('.ts-caret');
      if (defaultCaret) {
        defaultCaret.replaceWith(customIndicator);
      } else {
        const control = wrapper.querySelector('.ts-control');
        if (control) {
          control.appendChild(customIndicator);
        }
      }
      
      // Force the dropdown to rebuild its content
      tomSelectInstance.refreshOptions(false);
      
      // Store the instance for potential future use
      this.tomSelectInstances.push(tomSelectInstance);
      
      // Return the instance for potential chaining
      return tomSelectInstance;
    } catch (error) {
      console.error('Error initializing TomSelect:', error);
    }
  }
  
  // Helper method to get a specific TomSelect instance by index
  getInstance(index) {
    if (index >= 0 && index < this.tomSelectInstances.length) {
      return this.tomSelectInstances[index];
    }
    return null;
  }
  
  // Helper method to get all instances
  getAllInstances() {
    return this.tomSelectInstances;
  }
  
  // Helper method to destroy all instances
  destroy() {
    this.tomSelectInstances.forEach(instance => {
      if (instance && typeof instance.destroy === 'function') {
        instance.destroy();
      }
    });
    this.tomSelectInstances = [];
  }
  
  // Method to manually reinitialize all selects (can be called if needed)
  reinitializeAll() {
    // First destroy all existing instances
    this.destroy();
    
    // Then initialize all selects
    const allSelects = document.querySelectorAll('.select-custom');
    allSelects.forEach(selectElement => {
      this.initializeTomSelect(selectElement);
    });
  }
}

export default CustomSelect;