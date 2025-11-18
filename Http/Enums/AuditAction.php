<?php

namespace Http\Enums;

class AuditAction extends Enums
{
    // Generic
    const CREATE = 'Create';
    const UPDATE = 'Update';
    const DELETE = 'Delete';

    // Booking
    const BOOKING_CREATED = 'Booking Created';

    // Authentication
    const LOGIN = 'Login';
    const LOGOUT = 'Logout';
    const RESET_PASSWORD = 'Reset Password';

    // Reservation
    const RESERVATION_CREATED = 'Reservation Created';
    const RESERVATION_UPDATED = 'Reservation Updated';
    const RESERVATION_DELETED = 'Reservation Deleted';

    // Guests
    const GUEST_UPDATED = 'Guest Information Updated';

    // Payments
    const PAYMENT_UPDATED = 'Payment Updated';

    // Amenity
    const AMENITY_CREATED = 'Amenity Created';
    const AMENITY_UPDATED = 'Amenity Updated';
    const AMENITY_DELETED = 'Amenity Deleted';

    // Gallery Folder
    const GALLERY_CREATED = 'Gallery Folder Created';
    const GALLERY_UPDATED = 'Gallery Folder Updated';
    const GALLERY_DELETED = 'Gallery Folder Deleted';

    // Event
    const EVENT_CREATED = 'Event Created';
    const EVENT_UPDATED = 'Event Updated';
    const EVENT_DELETED = 'Event Deleted';

    // FAQ
    const FAQ_CREATED = 'FAQ Created';
    const FAQ_UPDATED = 'FAQ Updated';
    const FAQ_DELETED = 'FAQ Deleted';

    // User
    const USER_CREATED = 'User Created';
    const USER_UPDATED = 'User Updated';
    const USER_DELETED = 'User Deleted';

    // Promo
    const PROMO_CREATED = 'Promo Created';
    const PROMO_UPDATED = 'Promo Updated';
    const PROMO_DELETED = 'Promo Deleted';

    // Testimonial
    const TESTIMONIAL_CREATED = 'Testimonial Created';
    const TESTIMONIAL_UPDATED = 'Testimonial Updated';
    const TESTIMONIAL_DELETED = 'Testimonial Deleted';

    // Settings
    const SETTINGS_UPDATED = 'Settings Updated';
}
