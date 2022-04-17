using Microsoft.AspNetCore.Identity;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SocialNetwork.Data
{
    public class User : IdentityUser
    {
        public string? TelegramId { get; set; }
        public string? Description { get; set; }
        public string? Status { get; set; }
        public DateTime? BirthDate { get; set; }
        public string? ProfileUrl { get; set; }
        public string? FullName { get; set; }
        public string? Location { get; set; }
        public string? ImgUrl { get; set; }
        public string? Background { get; set; }
        
        //public List<User> Friends { get; set; }
        public List<User> Followers { get; set; }
        public List<User> Following { get; set; }

        public List<Post> Posts { get; set; }
        public List<Comment> Comments { get; set; }
        public List<Like> Likes { get; set; }
        public DateTime CreatedAt { get; set; }
    }
}
