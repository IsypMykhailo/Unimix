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
    public class GetLikesController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public GetLikesController(ApplicationDbContext context)
        {
            _context = context;
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<Like>>> Get(Guid id)
        {
            return await _context.Likes.Where(i => i.PostId == id).ToListAsync();
        }
    }
}
