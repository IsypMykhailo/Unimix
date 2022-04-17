using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using SocialNetwork.Data;

namespace SocialNetwork.Areas.Identity.Pages.Account.Manage
{
    public partial class IndexModel : PageModel
    {
        private readonly UserManager<User> _userManager;
        private readonly SignInManager<User> _signInManager;

        public IndexModel(
            UserManager<User> userManager,
            SignInManager<User> signInManager)
        {
            _userManager = userManager;
            _signInManager = signInManager;
        }

        public string Username { get; set; }

        [TempData]
        public string StatusMessage { get; set; }

        [BindProperty]
        public InputModel Input { get; set; }

        public class InputModel
        {
            [Display(Name ="Profile Image")]
            public string ImgUrl { get; set; }

            [Display(Name = "Profile Background")]
            public string Background { get; set; }

            [Display(Name = "Full Name")]
            public string FullName { get; set; }

            [Display(Name = "Description")]
            public string Description { get; set; }

            [Display(Name = "Status")]
            public string Status { get; set; }

            [Display(Name = "Telegram Id")]
            public string TelegramId { get; set; }

            [Display(Name = "Location")]
            public string Location { get; set; }

            [Phone]
            [Display(Name = "Phone number")]
            public string PhoneNumber { get; set; }
        }

        private async Task LoadAsync(User user)
        {
            var userName = await _userManager.GetUserNameAsync(user);
            var fullName = user.FullName;
            var phoneNumber = await _userManager.GetPhoneNumberAsync(user);
            var imgUrl = user.ImgUrl;
            var background = user.Background;
            var description = user.Description;
            var status = user.Status;
            var telegramId = user.TelegramId;
            var location = user.Location;

            Username = userName;

            Input = new InputModel
            {
                PhoneNumber = phoneNumber,
                ImgUrl = imgUrl,
                Background = background,
                FullName = fullName,
                Description = description,
                Status = status,
                TelegramId = telegramId,
                Location = location
            };
        }

        public async Task<IActionResult> OnGetAsync()
        {
            var user = await _userManager.GetUserAsync(User);
            if (user == null)
            {
                return NotFound($"Unable to load user with ID '{_userManager.GetUserId(User)}'.");
            }

            await LoadAsync(user);
            return Page();
        }

        public async Task<IActionResult> OnPostAsync(IFormFile fileToStorage, IFormFile backToStorage)
        {
            var user = await _userManager.GetUserAsync(User);

            if (user == null)
            {
                return NotFound($"Unable to load user with ID '{_userManager.GetUserId(User)}'.");
            }

            if (!ModelState.IsValid)
            {
                await LoadAsync(user);
                return Page();
            }

            var phoneNumber = await _userManager.GetPhoneNumberAsync(user);
            if (Input.PhoneNumber != phoneNumber)
            {
                var setPhoneResult = await _userManager.SetPhoneNumberAsync(user, Input.PhoneNumber);
                if (!setPhoneResult.Succeeded)
                {
                    StatusMessage = "Unexpected error when trying to set phone number.";
                    return RedirectToPage();
                }
            }

            if (fileToStorage != null)
            {
                user.ImgUrl = await Helpers.Media.UploadImage(fileToStorage, "UserAvatars");
                
            }
            if (backToStorage != null)
            {
                user.Background = await Helpers.Media.UploadImage(backToStorage, "UserBackgrounds");
            }
            if(Input.Description != user.Description)
            {
                user.Description = Input.Description;
            }
            if (Input.Status != user.Status)
            {
                user.Status = Input.Status;
            }
            if (Input.FullName != user.FullName)
            {
                user.FullName = Input.FullName;
            }
            if (Input.Location != user.Location)
            {
                user.Location = Input.Location;
            }
            if (Input.TelegramId != user.TelegramId)
            {
                user.TelegramId = Input.TelegramId;
            }
            await _userManager.UpdateAsync(user);

            await _signInManager.RefreshSignInAsync(user);
            StatusMessage = "Your profile has been updated";
            return RedirectToPage();
        }
    }
}
