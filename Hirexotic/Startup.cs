using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Hirexotic.Startup))]
namespace Hirexotic
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
