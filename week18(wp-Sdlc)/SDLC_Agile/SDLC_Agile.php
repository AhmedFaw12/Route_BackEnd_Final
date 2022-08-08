<?php  

/*
SDLC:
    -Software Development Life Cycle(SDLF)
    -we want to make software
    -there are steps to make software
    Steps:
        1)Requirement Analysis:
            -who take requirements from client
            -he is not developer , he is from business department(business analysist)
            -he have general knowledge
            -outcome is some documentation:
                -this documentation is called Business Requirement Specification(BRS)
                -this doc. is from business view , not from technical view

            -Business Analysist takes (BRS) and sits with head technical staff/person
            -head technical staff writes another Documentaion:
                -this doc is called (SRS)(Software requirement Specification)
                -this doc is from technical view


        2)Design:
            -not design or layout of website
            -it means the design of the system in general like:
                -what softwares/technologies that we will need in our project
                -what resources(servers, database) that we will need
                -if we will word cloud or shared host
                
            -design phase contain:
                -high level design:
                    -general
                -low level design:
                    -more details
            
            -outcome:
                -technologies, resources, how database is divided, database models, relations
                -general layout for website
                -distributing tasks
                
            -Technical staff do this phase(seniors, architect, some juniors)


        3)Implementaion:
            -writing code
            -seniors and juniors according to distributed tasks
            -simple and repititive tasks are taken by juniors according to distributed tasks
            -hard tasks are taken by seniors according to distributed tasks

        4)Testing:
            -it is done in parallel with implementation
            -tester of QC(quality control) , make test cases while implementation team are writing the code
            -if code passed test cases,then move to next phase
            
        Evolution:
            -deploy application on server 
            -client tries the application
            -then client advertise for his application
            -devops staff do this phase

            -if our company has marketing team, then we can offer client to advertise his application


    -SDLC reduces error rate/percentage but didn't prevent errors
    -if there is error at the beginning , error will propagate to the rest of phases/steps
    
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-DevOps:    
    -DevOps(development operations)
    -they install internal server of the company during development:
        -so that developer push their code on 
    -they also deploy application to live
    
    Requirements for Devops:
        -study virtual machine
        -Docker
        -AWS(amazon)

        -has certificates like(CCNA)
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-SEO:
    -SEO(Search Engine Optimization)
    -task for Online marketing team
    -makes our application easy to appear and spread between clients/users on (Google, facebook, ....)

    -html meta tags in the head of my website related to SEO
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-CTO(Chief Technology Officer): head of technical staff

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Agile:
    -it is better than SDLC
    -it depends on SDLC, but perform it multiple times
    -it is based on divide and conquer:
        -we will divide project to multiple sub-projects 
        -we will perform SDLC on each sub-project 
    
    -There are multiple methodology to implement Agile:
        -the most famous Methodology is called (Scrum)
        -Scrum :
            -Scrum is a framework of rules, roles, events, and artifacts used to implement Agile projects
            - It is an iterative approach, consisting of sprints that typically only last one to four weeks. This approach ensures that your team delivers a version of the product regularly

        Example:
            -Clinics systems:
                -we will make sub-system for booking:
                    -....
                -make sub-system for patients data:
                    -....
                -sub-system for clinic entry
                -....
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -How to Actually make SDLC in Agile:
        -we will first get whole project features which is called (Product Backlog)
        -we will take Product Backlog and divide it into releases:
            -release is something that can go live

        -we will divide each release is divided into sprints:
            -A sprint is a short, time-boxed period when a scrum team works to complete a set amount of work
            -sprint duration is 1-2 weeks
        
        -Planning meeting(Sprint Planning):
            -Planning meeting is a meeting held at the beginning of each sprint

            -Scrum Master collaborates with the Development Team and Product Owner , to decide what features will be done in that sprint

            -distribute tasks among team (who will make what and give him certain duration)
        
        -StandUp Meeting(Daily Scrum):
            -short Meeting is done every day, and everyone say what he has done yesterday and what problems he has faced , and what he will do today
            
            -meeting purpose is that :team continously communicate with eachother and not to work alone
        
        -Review Meeting(Sprint Review):
            -The sprint review is a meeting at the end of the sprint where the Scrum team and all stakeholders(الاطراف المعنية) get together and discuss what has been accomplished during the sprint and whether the sprint goal has been met.
        
            -is a meeting at the end of the sprint to check the increment

            -The product owner needs to inform the team about the tasks that have been completed and those that are not yet done.
            
            -The developers need to discuss problems they encountered during the sprint and how they were solved.
            
            -The Scrum team answers sprint-related questions from the rest of the team. 
            
            -The team should discuss which tasks come next, which provides a great basis for the next sprint planning meeting.

        -Retrospective Meeting(Sprint Retrospective):
            -The sprint retrospective meeting takes place immediately after the sprint review. While the sprint review is a discussion about what the team is building, the sprint retrospective is focused on how they’re building it.
        
            -This meeting is usually slightly shorter than the sprint review
            
            -For a successful sprint retrospective meeting, each team member should try to answer the following sprint retrospective questions:
                -What went well during the sprint?
                -Is there anything that can be improved?
                -How can we make those improvements?
        
        Roles in Scrum:
            -Scrum Master:
                -A Scrum Master leads the Agile development team and supports the Product Owner by relaying updates to relevant employees
                
                -Plan and execute the Agile Methodology with the Scrum development team.
                
                -Monitor the sprint's progress and remove roadblocks impeding the product's development.
                
                - Work with the Product Owner to make sure the product backlog is up to date.
                
                - Communicate changes in the product backlog to the development team.
                
                - Motivate the development team to complete tasks on time.
                
                - Report on the success of the sprint.


            -Product Owner:
                -Business Analyst in Agile is called Product Owner 

                -Product Owners manage the product backlog and ensure the company gains maximum value from the product.

                - Create and maintain product backlog.
                
                - Work with the Product Manager to create a product vision and roadmap.
                
                - Collaborate with the Scrum Master to ensure the product's development aligns with its original vision.
                
                - Ensure the product backlog is updated and available to the entire development team.
                
                - Work across departments and prioritize tasks for the Scrum Master based on stakeholder needs.
                
                - Evaluate progress throughout the development process.

            
            -Development Team:
                -QC
                -UI
                -Frontend
                -Backend
                -....
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -Conclusion:
        -project->features(product backlog)--> releases -->sprints(each sprint 1-2 weeks)
        -Agile is Mindset(طريقة تفكير)
    
    -from advantages of the agile:
        -it depends on visual Representation like :Burndown Chart:
           - A burndown chart is a tool used by Agile teams to gather information about work completed on a project and work to be done in a given time period.
           - Often, teams can use their burndown chart as a prediction tool that allows them to visualize when their project will be completed.
        
        -working with Boards/Trello:
            -To do: who will do what(tasks assigned to each employee)
            -doing:
            -done:
    ======================================================================================================================================================================================
    JIRA:        
        -Jira Software is an agile project management tool that supports any agile methodology, be it scrum, kanban, or your own unique flavor. 

        -From agile boards, backlogs, roadmaps, reports, to integrations and add-ons you can plan, track, and manage all your agile software development projects from a single tool

    -Trello:
        -project management tool where we can make board:
                -to do 
                -doing
                -done
                -issues

    
*/

?>