import sweetalert2 from 'sweetalert2';

export const toast = (title, icon = 'success', position = 'top-end') => {
  sweetalert2.fire({
    toast: true,
    showConfirmButton: false,
    position,
    icon,
    title,
    timer: 3000,
  });
}

export const sweetalert = sweetalert2;
