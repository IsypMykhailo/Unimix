using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using SocialNetwork.Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace SocialNetwork.Controllers.Api
{
    [Route("api/[controller]")]
    [ApiController]
    public class GetCommentsController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public GetCommentsController(ApplicationDbContext context)
        {
            _context = context;
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<Comment>>> Get(Guid id)
        {
            return await _context.Comments.Where(i => i.PostId == id).ToListAsync();
        }

        [HttpPost]
        public async Task<ActionResult<Comment>> Post(Comment comment)
        {
            var post = _context.Posts.Where(u => u.Id == comment.PostId).First();
            var author = _context.Users.Where(u => u.Id == comment.AuthorId.ToString()).First();
            _context.Comments.Add(new Comment()
            {
                Id = Guid.NewGuid(),
                Text = comment.Text,
                Post = post,
                PostId = comment.PostId,
                Author = author,
                AuthorId = comment.AuthorId,
                CreatedAt = DateTime.Now
            });
            await _context.SaveChangesAsync();

            return Ok();
            //return CreatedAtAction("GetComment", new { text = comment.Text, postId = comment.PostId, post=comment.Post, author = comment.Author, authorId = comment.AuthorId, createdAt = DateTime.Now }, comment);
        }
    }
}
