# Giftly - Personalized Gifts with Smart Pricing

Giftly is a web application that allows users to create and customize personalized gifts with dynamic pricing based on selected options.

## Features

- Customizable gift items (mugs, keychains, photo frames)
- Dynamic pricing based on selections
- Image upload and preview
- Shopping cart functionality
- Secure checkout process
- Order confirmation and tracking
- Responsive design for all devices

## Tech Stack

- Frontend:
  - HTML5
  - CSS3 (Custom styles with dark theme)
  - JavaScript (Dynamic pricing and interactions)
  - Font: Poppins

- Backend:
  - PHP (Form handling and order processing)
  - Session management
  - File-based order storage

## Installation

1. Clone the repository to your local machine
2. Place the files in your web server directory (e.g., XAMPP's htdocs folder)
3. Ensure PHP is properly configured on your server
4. Create the following directories with write permissions:
   - `uploads/` (for user-uploaded images)
   - `orders/` (for order storage)

## Directory Structure

```
Giftly/
├── index.php              # Homepage
├── customize.php          # Gift customization page
├── cart.php              # Shopping cart
├── checkout.php          # Checkout page
├── process_order.php     # Order processing
├── process_checkout.php  # Checkout processing
├── remove_item.php       # Cart item removal
├── purchases.php         # Purchase history
├── styles.css            # Main stylesheet
├── script.js             # Client-side scripts
├── uploads/              # User uploads directory
└── orders/               # Order storage directory
```

## Usage

1. Visit the homepage to browse available gift types
2. Click "Start Customizing" to begin creating a personalized gift
3. Select gift type, add custom text, and upload images
4. Choose packaging and delivery options
5. Add to cart and proceed to checkout
6. Enter shipping information and complete the order

## Security Considerations

- Input sanitization for all user inputs
- File upload restrictions
- Session management for cart functionality
- Secure form processing

## Future Enhancements

- Database integration for order storage
- User accounts and order history
- Payment gateway integration
- Admin dashboard
- Email notification system
- Product image gallery
- Gift wrapping options
- Bulk ordering capabilities

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 