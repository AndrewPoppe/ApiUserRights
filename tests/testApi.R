# This script assumes you have modified API/index.php in your REDCap instance to return a JSON response including the 
# content and action of the API call as opposed to attemting to include the corresponding php file.
# E.g., comment the line reading `include($post['content'] . "/$action.php");`
# and add the following line: `echo json_encode(array('content' => $post['content'], 'action' => $action));`

library(RCurl)
library(this.path)
library(jsonlite)

# Modify the following to match your REDCap instance
token <- '340AD10499C7012D5FF658608FC670F8'
url <- 'http://localhost:13740/api/'


# Nothing else needs to be modified

headers <- c(
  "Content-Type" = "application/x-www-form-urlencoded"
)

contents <- c('record',
             'metadata',
             'file',
             'fileRepository',
             'repeatingFormsEvents',
             'instrument',
             'event',
             'arm',
             'user',
             'project_settings',
             'report',
             'version',
             'pdf',
             'surveyLink',
             'surveyQueueLink',
             'surveyReturnCode',
             'participantList',
             'exportFieldNames',
             'formEventMapping',
             'project',
             'generateNextRecordName',
             'project_xml',
             'dag',
             'userDagMapping',
             'log',
             'userRole',
             'userRoleMapping',
             'invalid')

actions <- c('export',
            'import',
            'switch',
            'delete',
            'createFolder',
            'rename',
            'list',
            '',
            'invalid')

hasDatas <- c(TRUE, FALSE)

results <- data.frame(matrix(nrow=length(contents) * length(actions) * length(hasDatas),ncol=5))
names(results) <- c('content', 'action', 'hasData', 'resultContent', 'resultAction')

i <- 1
for (content in contents) {
  for (action in actions) {
    for (hasData in hasDatas) {
      params <- c('token' = token,
                 'content' = content,
                 'action' = action)
      if (hasData) {
        params <- c(params, 'data' = "[{\"record_id\":1}]")
      }
      
      resultContent <- ''
      resultAction <- ''
      
      tryCatch(
        expr = {
          res <- postForm(url, .params = params, .opts=list(httpheader = headers, followlocation=TRUE), style="post")
          result <- jsonlite::fromJSON(res)
          resultContent <- result$content
          resultAction <- result$action
        },
        error = function(e) {
          print(c(content, action, hasData,e$message))
        },
        warning = function (w) {
          print(c(content, action, hasData, w$message))
        },
        finally = {
          results[i,] <- c(content, action, hasData, resultContent, resultAction)
          i <- i + 1
        }
      )
    }
  }
}

sink(paste0(dirname(this.path()), .Platform$file.sep, 'testData.json'), type='output')
cat(toJSON(results, pretty=TRUE))
sink()


