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
    public class ApiPostsController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public ApiPostsController(ApplicationDbContext context)
        {
            _context = context;
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<Post>>> Get(Guid id)
        {
            return await _context.Posts.Where(i => i.AuthorId == id).ToListAsync();
        }
    }
}
