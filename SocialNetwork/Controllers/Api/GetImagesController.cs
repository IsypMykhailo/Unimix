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
    public class GetImagesController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public GetImagesController(ApplicationDbContext context)
        {
            _context = context;
        }

        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<Image>>> Get(Guid id)
        {
            return await _context.Images.Where(i => i.PostId == id).ToListAsync();
        }
    }
}
