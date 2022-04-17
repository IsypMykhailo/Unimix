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
    public class ApiFollowsController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public ApiFollowsController(ApplicationDbContext context)
        {
            _context = context;
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<User>>> Get(Guid id)
        {
            return await _context.Users.Include(u=>u.Followers).Include(u=>u.Following).Where(u=> u.Id == id.ToString()).ToListAsync();
        }
    }
}
