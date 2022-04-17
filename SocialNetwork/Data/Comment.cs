using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Threading.Tasks;

namespace SocialNetwork.Data
{
    public class Comment
    {
        [Key, DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public Guid Id { get; set; }
        public string Text { get; set; }
        public Post Post { get; set; }
        public Guid PostId { get; set; }
        public User Author { get; set; }
        public Guid AuthorId { get; set; }

        public Comment? ParentComment { get; set; }
        public List<Comment>? ChildrenComments { get; set; }
        public DateTime CreatedAt { get; set; }
    }
}
